#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <ctype.h>
#include <time.h>

#define PORT 4444

void checker(int newSocket,char location[],char buffer[],char district[]){
		FILE *fptr;
		char pitem[1024];
		int words = 0;
		fptr = fopen(location,"r");

		if(fptr ==NULL){
			printf("file not found \n");
			exit(EXIT_FAILURE);
		}
		//get the number of occurances of the item
		while(fgets(pitem,1024,fptr)!=NULL){
			int totalRead = strlen(pitem);

			pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];
			if(strstr(pitem,buffer)!=NULL){
				words++;
			}
		}
		printf("%d\n",words);
		send(newSocket, &words, sizeof(int),0);
		rewind(fptr);
		while(fgets(pitem,1024,fptr)!=NULL){
			int totalRead = strlen(pitem);
			pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];
			if(strstr(pitem,buffer)!=NULL){
				send(newSocket,pitem,sizeof(pitem),0);	
			}
		}					
}
int splitter(char data[],char check[],char dis[]){
	char delim[] = ",";
	char *ptr = strtok(data, delim);  
	int i = 0;
	char *ptx[10];
	while(ptr!=NULL){                                
		ptx[i] = ptr;
		i++;
		ptr = strtok(NULL,delim);
	}
	if(i > 2){
		//check if recommender exists in file
		FILE *fptr;
		char pitem[1024];
		char location[1024];
		sprintf(location,"uft_recess/storage/app/recommender/%s.txt",dis);
      //sprintf(location,"recommender.txt");
		fptr = fopen(location,"r");
			if(fptr ==NULL){
				printf("file not found \n");
				exit(EXIT_FAILURE);
			}
			while(fgets(pitem,1024,fptr)!=NULL){
				int totalRead = strlen(pitem);

				pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];
				if(strstr(pitem,ptx[2])!=NULL){
					strcpy(check,"ok");
					break;

				}
			}
	}
    //if no recommender arguement supplied
	else{
	strcpy(check,"ok");
	}

	return 0;
}
int currdate(char timex[]){
    time_t t = time(NULL);
    struct tm *tm = localtime(&t);
    strftime(timex,1024,"%Y-%m-%d",tm);
	return 0;
}

int addmember(char arr[],char dis[],char dater[]){
	char location[1024];
	sprintf(location,"uft_recess/storage/app/enrollments/%s.txt",dis);
  //sprintf(location,"bugiri.txt");

	FILE *fp;
	   fp =fopen(location,"a");
	   	int totalRead = strlen(arr);
		arr[totalRead - 1] = arr[totalRead - 1] == '\n' ? '\0' : arr[totalRead - 1];
	   sprintf(arr,"%s,%s",arr,dater);
	   fputs(arr,fp);
	   fputs("\n",fp);
	   fclose(fp);

	return 0;
}


//triming of the strings 
void ltrim(char str[])
{
        int i = 0, j = 0;
        char buf[1024];
        strcpy(buf, str);
        for(;str[i] == ' ';i++);

        for(;str[i] != '\0';i++,j++)
                buf[j] = str[i];
        buf[j] = '\0';
        strcpy(str, buf);
}

int main(){

int day, month, year;
    time_t now;
    time(&now);
    struct tm *local = localtime(&now);
    day = local->tm_mday;        	// get day of month (1 to 31)
    month = local->tm_mon + 1;   	// get month of year (0 to 11)
    year = local->tm_year + 1900;	// get year since 1900
	
	int sockfd, ret;
	 struct sockaddr_in serverAddr;
	int newSocket;
	struct sockaddr_in newAddr;
	socklen_t addr_size;
	pid_t childpid;
	sockfd = socket(AF_INET, SOCK_STREAM, 0);
	if(sockfd < 0){
		puts("Error in connection.");
		exit(1);
	}
	puts("Server Socket is created.");

	memset(&serverAddr, '\0', sizeof(serverAddr));
	serverAddr.sin_family = AF_INET;
	serverAddr.sin_port = htons(PORT);
	serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

	ret = bind(sockfd, (struct sockaddr*)&serverAddr, sizeof(serverAddr));
	if(ret < 0){
		puts("Error in binding.");
		exit(1);
	}
	printf("Bind to port %d\n", 4444);

	if(listen(sockfd, 10) == 0){
		printf("Listening....\n");
        printf("Listening...\n");
         printf("*-----------'''''''''  U F T   '''''''''-------------*\n");
		 printf("-----------------------------------------------------\n");
         printf("           UNITED FRONT FOR TRANSFORMATION           \n");
         printf("-----------------------------------------------------\n");
         printf("Date: %02d/%02d/%d\n", day, month, year);
	}else{
		printf("Error in binding.\n");
	}
	while(1){	
		newSocket = accept(sockfd, (struct sockaddr*)&newAddr, &addr_size);
		if(newSocket < 0){
			exit(1);
		}
		printf("Connection accepted from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));
		if((childpid = fork()) == 0){
			close(sockfd);

			while(1){
				char buffer[1024];
				char district[1024];
				char user[1024];

				char cdate[1024];

				currdate(cdate);
				recv(newSocket,buffer,1024,0);

				if(strcmp(buffer, "Addmember") == 0){
					recv(newSocket,district,1024,0);
					recv(newSocket,buffer,1024,0);

					//variables to be used
					char test[1024];
					strcpy(test,buffer);
					char check[100] = "fail";

					if(strcmp(buffer,"file") ==0){
						bzero(buffer,sizeof(buffer));
						FILE *fp;
						int ch = 0;
						int words;
						char location[1024];
					sprintf(location,"uft_recess/storage/app/enrollments/%s.txt",district);
					//sprintf(location,"bugiri.txt");
						fp =fopen(location,"a");
						recv(newSocket, &words, sizeof(int),0);				
						//printf("%d\n",words);
						while(ch != words){
							recv(newSocket,buffer,1024,0);
							//printf("%s",buffer);
							splitter(test,check,district);

							if(strcmp(check,"ok")==0){
								//puts("file ok");
								addmember(buffer,district,cdate);
								sprintf(buffer,"\tcommand allowed");
								send(newSocket,buffer,sizeof(buffer),0);							
							}
							else{
								//puts("file failer");
								sprintf(buffer,"Recommender not found in the database");
								send(newSocket,buffer,sizeof(buffer),0);

							}
							
							ch++;
							//printf("%d\n",ch);
						}
						fputs("\n",fp);
						fclose(fp);
						//creating a signature file                  
					}
					else{
						//splitting and checking the recommender
						splitter(test,check,district);

                        if(strcmp(check,"ok")==0){
							//puts("add ok");
							addmember(buffer,district,cdate);
							sprintf(buffer,"\t command allowed");
							send(newSocket,buffer,sizeof(buffer),0);

						}
						else{
							sprintf(buffer,"Recommender not found in the database");
							send(newSocket,buffer,sizeof(buffer),0);

						}
						
					}
					bzero(buffer,sizeof(buffer));
					
				}
				else if(strcmp(buffer, "search") == 0){
					char location[1024];
					recv(newSocket,district,1024,0);
					recv(newSocket,buffer,1024,0);
					puts(district);
					puts(buffer);
				
					sprintf(location,"uft_recess/storage/app/enrollments/%s.txt",district);
               // sprintf(location,"bugiri.txt");

					   //call the search module
					checker(newSocket,location,buffer,district);

				}
				else if(strcmp(buffer, "check_status") == 0){
					bzero(buffer,sizeof(buffer));
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket, user, sizeof(user),0);
									
				}
				else if(strcmp(buffer, "get_statement") == 0){
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket, user, sizeof(user),0);

					char location[1024];
					sprintf(location,"uft_recess/storage/app/payments/%s.txt",district);
					//sprintf(location,"bugiri.txt");
					//call the search module
				    checker(newSocket,location,user,district);
				}

				else if(strcmp(buffer, "Done") == 0){
					
					printf("Disconnected from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));
				}
			}
		}

	}
	close(newSocket);
	return 0;
}
