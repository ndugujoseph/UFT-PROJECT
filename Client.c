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

//search receiver function
void receiver(int clientSocket,char buffer[],char district[]){
	send(clientSocket,district,1024,0);
	send(clientSocket, buffer,1024, 0);
	int ch = 0;
	int words;

	//receive search data from the server
	recv(clientSocket,&words,sizeof(int),0);
	printf("%d\n",words);				
	while(ch != words){
		recv(clientSocket, buffer, 1024, 0);
		puts(buffer);
		ch++;
	}
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
}//

void sign(){
	int sign[10][10];
    for(int x=1;x<6;x++){
        for(int j=1;j<4;j++){
            printf("\nCell(%d,%d)-",x,j);
            scanf("%d",&sign[x][j]);
			 }
       
    }

    for(int x=1;x<6;x++){
        for(int j=1;j<4;j++){
            if(sign[x][j] == 1){
                printf("*");
            }
            else {
                printf(" ");
            }
            
        }
        printf("\n");
    }
    //checking signature
    if(sign[1][1] == 0){
        if(sign[1][2] == 1){
            if(sign[1][3] == 0){
                if(sign[2][1] == 1){
                    if(sign[2][2] == 0){
                        if(sign[2][3] == 1){
                            if(sign[3][1] == 1){
                                if(sign[3][2] == 1){
                                    if(sign[3][3] == 1){
                                        if(sign[4][1] == 1){
                                            if(sign[4][2] == 0){
                                                if(sign[4][3] == 1){
                                                    if(sign[5][1] == 1){
                                                        if(sign[5][2] == 0){
                                                            if(sign[5][3] == 1){
                                                                printf("the signature is A\n");
                                                                FILE*fptr;
                                                                fptr=fopen("bugiri.txt","a");
                                                                fprintf(fptr,"A\n");
                                                                fclose(fptr);
                                                            }}}}}}}}}}}}}}}

    if(sign[1][1] == 1){
        if(sign[1][2] == 1){
            if(sign[1][3] == 0){
                if(sign[2][1] == 1){
                    if(sign[2][2] == 0){
                        if(sign[2][3] == 1){
                            if(sign[3][1] == 1){
                                if(sign[3][2] == 1){
                                    if(sign[3][3] == 0){
                                        if(sign[4][1] == 1){
                                            if(sign[4][2] == 0){
                                                if(sign[4][3] == 1){
                                                    if(sign[5][1] == 1){
                                                        if(sign[5][2] == 1){
                                                            if(sign[5][3] == 0){
                                                                printf("the signature is B\n");
                                                                FILE*fptr;
                                                                fptr=fopen("bugiri.txt","a");
                                                                fprintf(fptr,"B\n");
                                                                fclose(fptr);
                                                            }}}}}}}}}}}}}}}

    if(sign[1][1] == 0){
        if(sign[1][2] == 1){
            if(sign[1][3] == 1){
                if(sign[2][1] == 1){
                    if(sign[2][2] == 0){
                        if(sign[2][3] == 0){
                            if(sign[3][1] == 1){
                                if(sign[3][2] == 0){
                                    if(sign[3][3] == 0){
                                        if(sign[4][1] == 1){
                                            if(sign[4][2] == 0){
                                                if(sign[4][3] == 0){
                                                    if(sign[5][1] == 0){
                                                        if(sign[5][2] == 1){
                                                            if(sign[5][3] == 1){
                                                                printf("the signature is C\n");
                                                                FILE*fptr;
                                                                fptr=fopen("bugiri.txt","a");
                                                                fprintf(fptr,"C\n");
                                                                fclose(fptr);
                                                            }}}}}}}}}}}}}}}
}


int main(){

	int clientSocket, ret;
	struct sockaddr_in serverAddr;
	int day, month, year;
    time_t now;
    time(&now);
    struct tm *local = localtime(&now);
    day = local->tm_mday;        	// get day of month (1 to 31)
    month = local->tm_mon + 1;   	// get month of year (0 to 11)
    year = local->tm_year + 1900;	// get year since 1900

	clientSocket = socket(AF_INET, SOCK_STREAM, 0);
	if(clientSocket < 0){
		puts("Error in connection....try again!!!\n");
		exit(1);
	}
	puts("Client Socket is created\n");

	memset(&serverAddr, '\0', sizeof(serverAddr));
	serverAddr.sin_family = AF_INET;
	serverAddr.sin_port = htons(PORT);
	serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

	ret = connect(clientSocket, (struct sockaddr*)&serverAddr, sizeof(serverAddr));
	if(ret < 0){
		puts("Error in connection....try again!!!\n");
		exit(1);
	}
printf("*-----------'''''''''  U F T   '''''''''-------------*\n");
	 printf("-----------------------------------------------------\n");
     printf("           UNITED FRONT FOR TRANSFORMATION           \n");
     printf("-----------------------------------------------------\n");
     printf("Date: %02d/%02d/%d\n", day, month, year);

	 printf("To addmember use=> Addmember member_name,gender,recommender, \n");
	 printf("To addmember using file=> Addmember textfile.txt\n");
	 printf("After adding member(s) use    'Done'   to enter signature\n");
     printf("        -----   Thank you   -----\n");


    char district[1024];
	char username[1024];
	char password[10];
    printf("\nEnter district:\t");
	scanf("%s",district);
	
	printf("\nEnter username:\t");
    scanf("%s",username);

	while(1){
		char buffer[1024];

		bzero(buffer,sizeof(buffer));

		printf("\nEnter Command:\t");
		scanf("%s", &buffer[0]);

		if(strcmp(buffer, "Done") == 0){
           	puts("Please enter your signature below!");
			printf("Sign:\n");
			//calling the sign module
			sign();

			send(clientSocket, buffer, strlen(buffer), 0);
			close(clientSocket);
			puts("Your are disconnected from server.");
			exit(1);
		}
		else if(strcmp(buffer, "Addmember") == 0){
			send(clientSocket,buffer,1024,0);
			send(clientSocket,district,sizeof(district),0);
			scanf("%[^\n]s",buffer);
			ltrim(buffer);//trimming
		    int words = 0;
			FILE *fp;
			fp =fopen(buffer, "r");
			if(fp == NULL){
				send(clientSocket,buffer,1024,0);
				recv(clientSocket,buffer,1024,0);
				  //printf("\nRESPONSE:");
				puts(buffer);
			}
			else{  
				bzero(buffer,sizeof(buffer));
				char file[1024] = "file";
				send(clientSocket,file,sizeof(file),0);
				while(fgets(buffer,1024,fp)!=NULL){
					words++;
				}
				printf("%d\n",words);
				send(clientSocket, &words, sizeof(int),0);
				rewind(fp);

				char ch;
				while(fgets(buffer,1024,fp)!= NULL){
					send(clientSocket,buffer,1024,0);
					recv(clientSocket,buffer,1024,0);
					puts(buffer);		 			
				}			
               puts("Your text file was sent successfully\n\n");
               fclose(fp);
			}
		}			
		else if(strcmp(buffer, "search") == 0){
			puts(buffer);
			send(clientSocket, buffer, strlen(buffer), 0);
			scanf("%s",buffer);
			ltrim(buffer);
			puts(buffer);

			//receiver module
            receiver(clientSocket,buffer,district);
		}
		else if(strcmp(buffer, "check_status") == 0){
			send(clientSocket, buffer, sizeof(buffer), 0);
			send(clientSocket, district, sizeof(district), 0);
			send(clientSocket, username, sizeof(username), 0);
		}
		else if(strcmp(buffer, "get_statement") == 0){
			send(clientSocket, buffer, sizeof(buffer), 0);

			//check module
            receiver(clientSocket,username,district);
		}
		else{
			puts("\nCommmand used is invalid!!!!!");
		}
	}
	return 0;
}
