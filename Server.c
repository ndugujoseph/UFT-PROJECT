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

/*/cheking * addd coverting them to respective letter
	     int A[3][5]={0,1,0,1,0,1,1,1,1,1,0,1,1,0,1};
	     int B[3][5]={1,1,0,1,0,1,1,1,0,1,0,1,1,1,0};
		 //int C[3][5]={0,1,0,1,0,1,1,1,1,1,0,1,1,0,1};
	     //int D[3][5]={1,1,0,1,0,1,1,1,0,1,0,1,1,1,0};
	     int a,b;
		 char *sg[26]={A,B};
	     if(sign[x][j]==A[a][b]){
		    printf("Signature:%s\n",*(sg));

	          }
		  else if(sign[x][j]==B[a][b])
		  {
			  printf("Signature:%s\n",*(sg+1));
		  }
		  
	  else
	  {
		  printf("Signature not found\n");
	  }*/
	  

#define PORT 4444

int currdate(char timex[]){
    time_t t = time(NULL);
    struct tm *tm = localtime(&t);
    strftime(timex,1024,"%d/%m/%y",tm);
	return 0;
}

int addmember(char arr[],char dis[],char dater[]){
	FILE *fp;
	   fp =fopen(strcat(dis,"bugiri.txt"),"a");
       arr = strcat(arr, dater);
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

	char buffer[1024];
	pid_t childpid;

	sockfd = socket(AF_INET, SOCK_STREAM, 0);
	if(sockfd < 0){
		printf("Error in connection.\n");
		exit(1);
	}
	printf("Server Socket is created.\n");

	memset(&serverAddr, '\0', sizeof(serverAddr));
	serverAddr.sin_family = AF_INET;
	serverAddr.sin_port = htons(PORT);
	serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

	ret = bind(sockfd, (struct sockaddr*)&serverAddr, sizeof(serverAddr));
	if(ret < 0){
		printf("Error in binding.\n");
		exit(1);
	}
	printf("Bind to port %d\n", 4444);

	if(listen(sockfd, 10) == 0){
		printf("Listening...\n");
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
				char district[1024];
				char user[1024];

				char cdate[1024];

				currdate(cdate);

				int readx = recv(newSocket,buffer,1024,0);
		        buffer[readx] = '\0';

				if(strcmp(buffer, "Addmember") == 0){
					recv(newSocket,district,1024,0);
					readx = recv(newSocket,buffer,1024,0);
					buffer[readx] = '\0';
					if(strcmp(buffer,"file") ==0){
						bzero(buffer,sizeof(buffer));
						FILE *fp;
						int ch = 0;
						char filex[1024];
						fp =fopen(strcat(district,".txt"),"a");
						recv(newSocket, filex, sizeof(filex),0);
						int words = atoi(filex); //string to int conversion
						printf("%d",words);
						while(ch != words){
							recv(newSocket,buffer,1024,0);
							fprintf(fp, "%s " ,buffer);
							ch++;
						}
						fputs("\n",fp);
						fclose(fp);


					}
					else{
						addmember(buffer,district,cdate);
					}
					
				}
				else if(strcmp(buffer, "search") == 0){
					recv(newSocket,district,1024,0);
					readx = recv(newSocket,buffer,1024,0);
					buffer[readx] = '\0';
					printf("%s\n",district);
					   //call the search module
	    				FILE *fptr;
						char pitem[1024];

						fptr = fopen(strcat(district,".txt"),"r");
 
						if(fptr ==NULL){
							printf("file not found \n");
							exit(EXIT_FAILURE);
						}

						while(fgets(pitem,1024,fptr)!=NULL){
							int totalRead = strlen(pitem);

							pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];

							if(strstr(pitem,buffer)!=NULL){
								printf("%s\n",pitem);

								send(newSocket,pitem,sizeof(pitem),0);
					
							}

						}
						char *fin ="complete";
						send(newSocket,fin,sizeof(fin),0);


				}
				else if(strcmp(buffer, "check_status") == 0){
					bzero(buffer,sizeof(buffer));
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket, user, sizeof(user),0);
					

				}
				else if(strcmp(buffer, "get_statement") == 0){
					printf("statement\n");
				}

				else if(strcmp(buffer, "exit") == 0){
					printf("Disconnected from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));
				}
			
		        /* else{
				send(newSocket, buffer, strlen(buffer), 0);
				}
				*/
			}
		}

	}

	close(newSocket);

	return 0;
}
