#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <ctype.h>
#include <malloc.h>
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
}

char sign(char signature[]){
	while(1){
		char *str;
		int total=0;
		char *key[2][26] = {"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "010101101111101", "110101110101110", "001010100010001", "110101101101110", "111100111100111", "111101111100100", "001010100011010", "101101111101101", "111010010010111", "111010010010110", "101110100110101", "100100100100111", "101111101101101", "010101101101101","010101101101010" ,"110101110100100","010101101111011","110101110101101","111100111001111","111010010010010","101101101101111","101101101101010","101101101111101","101101010101101","101101111001111","111001010100111"};
		char *sign[5][3];
		int num;
		for(int i=0;i<5;i++){
			for(int j=0;j<3;){
				printf("cell(%d,%d)-",i,j);
				sign[i][j] = (char *)malloc(2);
				scanf("%d",&num);
				sprintf(sign[i][j],"%d",num);
				if(num==0 || num ==1){
					j++;
					total += sizeof(sign[i][j]);
					continue;
				}
				puts("WRONG INPUT");
				
			}
		}

		for(int i=0;i<5;i++){
			for(int j=0;j<3;j++){
				if(strcmp(sign[i][j],"1")==1){
					printf("*");
				}
				else{
					if(strcmp(sign[i][j],"0")==0){
					printf(" ");
			}
		
		}
				printf("\n");
		}
		str = (char *)malloc(total + 1);
		for (int i = 0; i < 5; i++)
		{
			for (int j = 0; j < 3; j++)
			{
				if (j == 0 && i == 0)
				{
					strcpy(str, sign[i][j]);
				}
				else
				{
					strcat(str, sign[i][j]);
				}
			}
		}
		puts(str);
		for (int i = 0; i < 5; i++)
		{
			for (int j = 0; j < 3; j++)
			{
				free(sign[i][j]);
			}
		}
	int found = 0;
		for (int n = 0; n < 26; n++)
		{
			if (strcmp(key[1][n], str) == 0)
			{
				strcpy(signature, key[0][n]);
				found = 1;
				break;
			}
		}
		if (found == 0)
		{
			puts("Wrong signature was entered\n");
			
			puts("----POSSIBLE SIGNATURE-----");
			for(int i=0;i<26;i++){
				for(int j=0;j<2;j++){
					printf("%s\t",key[j][i]);
				}
				printf("\n");
			}

			puts("---END OF LISTS-----");
			
		}
		else{
		printf("The signature is: %s \n", signature);
		//break;
		exit(1);
		}
    free(str);
	}
  }
}

int main() {

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
		puts("Error in connection.");
		exit(1);
	}
	puts("Client Socket is created.");

	memset(&serverAddr, '\0', sizeof(serverAddr));
	serverAddr.sin_family = AF_INET;
	serverAddr.sin_port = htons(PORT);
	serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

	ret = connect(clientSocket, (struct sockaddr*)&serverAddr, sizeof(serverAddr));
	if(ret < 0){
		puts("Error in connection.");
		exit(1);
	}
printf("*-----------'''''''''  U F T   '''''''''-------------*\n");
	 printf("-----------------------------------------------------\n");
     printf("           UNITED FRONT FOR TRANSFORMATION           \n");
     printf("-----------------------------------------------------\n");
     printf("Date: %02d/%02d/%d\n", day, month, year);

	 printf("To addmember use=> Addmember member_name,gender,recommender, \n");
	 printf("To addmember using file=> Addmember textfile.txt\n");
	 printf("To view payment history=> get_statement");
	 printf("To view Validity and completeness of file=> check_status");
	 printf("After adding member(s) use  'Done'  to enter signature\n");
     printf("        -----   Thank you   -----\n");

    char district[1024];
	char username[1024];
	char signature[10];
    printf("\nEnter district:\t");
	scanf("%s",district);
	
	printf("\nEnter username:");
    scanf("%s",username);

	while(1){
		char buffer[1024];

		bzero(buffer,sizeof(buffer));

		printf("\nEnter Command:\t");
		scanf("%s", &buffer[0]);

		if(strcmp(buffer, "exit") == 0){
			send(clientSocket, buffer, strlen(buffer), 0);
			close(clientSocket);
			puts("Your are disconnected from server.");
			exit(1);
		}
	    else if(strcmp(buffer, "Done") == 0){
			send(clientSocket, buffer, sizeof(buffer), 0);
			send(clientSocket, username, sizeof(username), 0);
			send(clientSocket, district, sizeof(district), 0);
			puts("Please enter your signature below!");
			printf("To sign:\n");
           //calling the sign module
			sign(signature);
            send(clientSocket, signature, sizeof(signature), 0);
			puts(signature);
		}
		
		else if(strcmp(buffer, "Addmember") == 0){
			send(clientSocket,buffer,1024,0);
			send(clientSocket,district,sizeof(district),0);
			send(clientSocket,username,sizeof(username),0);
			scanf("%[^\n]s",buffer);
			ltrim(buffer);//trimming
		    int words = 0;
			FILE *fp;
			fp =fopen(buffer, "r");
   			if(fp == NULL){
				send(clientSocket,buffer,1024,0);
				recv(clientSocket,buffer,1024,0);
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
				    int totalRead = strlen(buffer);
				    buffer[totalRead - 1] = buffer[totalRead - 1] == '\n' ? '\0' : buffer[totalRead - 1];
					send(clientSocket,buffer,1024,0);
					recv(clientSocket,buffer,1024,0);
					puts(buffer);
		 			
				}
				puts("Your text file was sent successfully\n\n");
				fclose(fp);
			}
		}	
		
		else if(strcmp(buffer, "search") == 0){
			send(clientSocket, buffer, strlen(buffer), 0);
			scanf("%s",buffer);
			ltrim(buffer);

			//receiver module
			printf("Searching for %s",buffer);
			sleep(2);
			puts("**----Search Results-----**");
            receiver(clientSocket,buffer,district);
			puts("   Searching Accomplished ~~~~~~~");
		}
		else if(strcmp(buffer, "check_status") == 0){
			char message[1024];
			send(clientSocket, buffer, sizeof(buffer), 0);
			send(clientSocket, district, sizeof(district), 0);
			send(clientSocket, username, sizeof(username), 0);
			recv(clientSocket, message, sizeof(message), 0);

			if(strcmp(message,"change") == 0){
				bzero(buffer,sizeof(buffer));
				recv(clientSocket, message, sizeof(message), 0);
				puts(message);
				puts("Please submit your signature to continue:");
				sign(signature);
				
				char correct[1024];
				sprintf(correct,"%s:%s",username,signature);
				sprintf(buffer,"correct");
				send(clientSocket,buffer, sizeof(buffer), 0);
			    send(clientSocket,username, sizeof(username),0);
				send(clientSocket,district, sizeof(district),0);
				send(clientSocket,correct, sizeof(correct),0);
				recv(clientSocket,buffer, sizeof(buffer), 0);
				puts(buffer);
				bzero(buffer,sizeof(buffer));
			}
			else{
				puts(message);
			}
        bzero(buffer,sizeof(buffer));
		}
		else if(strcmp(buffer, "get_statement") == 0){
			send(clientSocket, buffer, sizeof(buffer), 0);
			//check module
			puts("\tYour salary details are as follow;");
            receiver(clientSocket,username,district);
			puts("\n\t Thanks for your cooperation!!!!!!");
		}
		else{
			printf("\nCommmand used is invalid  !!!!!");
		}
	}
	return 0;

}

