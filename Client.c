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

//triming of the strings 
void ltrim(char str[])
{
        int x = 0, j = 0;
        char buf[1024];
        strcpy(buf, str);
        for(;str[x] == ' ';x++);

        for(;str[x] != '\0';x++,j++)
                buf[j] = str[x];
        buf[j] = '\0';
        strcpy(str, buf);
}

void sign(){

	int sign[10][10];
    for(int x=1;x<6;x++){
        for(int j=1;j<4;j++){
            printf("\nCell(%d,%d)-",x,j);
            scanf("%d",&sign[x][j]);
        }
    }




    for(int x=1;x
	<6;x++){
        for(int j=0;j<4;j++){
            if(sign[x][j] == 0){
                printf(" ");
            }
            else {
                printf("*");
            }
            
        }
        printf("\n");
    }
	
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
			}}}}}}}}}}}}}}}

	if(sign[1][1] == 1){
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
		if(sign[5][1] == 1){
		if(sign[5][2] == 1){
		if(sign[5][3] == 1){
		
	printf("the signature is C\n");
		
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
		printf("[-]Error in connection.\n");
		exit(1);
	}
	printf("Client Socket is created.\n");

	memset(&serverAddr, '\0', sizeof(serverAddr));
	serverAddr.sin_family = AF_INET;
	serverAddr.sin_port = htons(PORT);
	serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

	ret = connect(clientSocket, (struct sockaddr*)&serverAddr, sizeof(serverAddr));
	if(ret < 0)
	{
		printf("Error in connection.\n");
		exit(1);
	}

	 printf("-----------------------------------------------------\n");
     printf("           UNITED FRONT FOR TRANSFORMATION           \n");
     printf("-----------------------------------------------------\n");
     printf("Date: %02d/%02d/%d\n", day, month, year);
    char district[1024];
	char username[1024];

	
	
	printf("Use Addmember to add member_name,gender,recommender,date respectively.Thank you!\n");
	
	while(1){
		char buffer[1024];

		bzero(buffer,sizeof(buffer));
		printf("\nAdd_New_Member: \t");
		scanf("%s", &buffer[0]);

		if(strcmp(buffer, "done") == 0){
			puts("Please enter your signature below!");
			printf("Sign:\n");
		 //calling the sign module
			sign();
			send(clientSocket, buffer, strlen(buffer), 0);
			close(clientSocket);
			printf("Disconnected from server.\n");
			exit(1);
		}
		else if(strcmp(buffer, "Addmember") == 0){
			send(clientSocket,buffer,1024,0);
			send(clientSocket,district,sizeof(district),0);
			scanf("%[^\n]s",buffer);
			char *file = buffer;
			ltrim(file);//trimming
			FILE *fp;
			int words = 0;
			char c;
			fp =fopen(file, "r");
			if(fp == NULL){
				send(clientSocket,buffer,1024,0);
			}
			else{  
				bzero(buffer,sizeof(buffer));
				file = "file";
				send(clientSocket,file,sizeof(file),0);
				while((c = getc(fp)) != EOF){
					fscanf(fp,"%s",buffer);
					if(isspace(c) || c =='\t'){
					words++;
					}
				}
				char size[1024];
				sprintf(size,"%d",words);//int to string convertion
				send(clientSocket, size, sizeof(size),0);
				rewind(fp);

				char ch;
				while(ch != EOF){
					fscanf(fp,"%s",buffer);
					send(clientSocket,buffer,1024,0);
		 			ch = fgetc(fp);
				}
				fclose(fp);
               printf("sent successfully\n");

			}
		}	
		
		else if(strcmp(buffer, "search") == 0){
			send(clientSocket, buffer, strlen(buffer), 0);
			scanf("%s",buffer);
			ltrim(buffer);
			send(clientSocket,district,sizeof(district),0);
			send(clientSocket, buffer, strlen(buffer), 0);
            bzero(buffer,sizeof(buffer));

			printf("%s\n",district);
			printf("Ndugu Joseph\n");
			//receive search data from the server
			recv(clientSocket,buffer,strlen(buffer),0);

			while(1){
				printf("loop\n");
				recv(clientSocket,buffer,strlen(buffer),0);
				if(strcmp(buffer,"complete")){
					printf("break hit\n");
					break;
					
				}  
				printf("%s\n",buffer);
			}
			
			
		}
		else if(strcmp(buffer, "check_status") == 0){
			send(clientSocket, buffer, sizeof(buffer), 0);
            send(clientSocket,district,sizeof(district),0);
			send(clientSocket,username,sizeof(username),0);


			//check module

		}
		else if(strcmp(buffer, "get_statement") == 0){
			send(clientSocket, buffer, strlen(buffer), 0);
			//statement check
		}
		else{
			printf("Searching...Command not found\n");
		}

        //recv(clientSocket, buffer, 1024, 0);
		//printf("Error in receiving data.\n");
 

	}
	return 0;
}
