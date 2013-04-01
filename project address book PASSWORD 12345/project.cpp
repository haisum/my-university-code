#include<stdio.h>
#include<conio.h>
#include<stdlib.h>
#include<string.h>
main()
{
      FILE *ab, *cd;
      int smenu, count=0, del;
      char note='y', edited='n';
      char c1 = ' ';
      struct addressbook
      {
             char name[100];
             char address[100];
             char email[100];
             char phone[100];
             char mobile[100];
      };
      struct addressbook aaa;
      for(int s=0;s<=60;s++)
      {
              printf("\4");
      }
      printf("\n\t\t   WELCOME TO ADDRESSBOOK\n");
      printf("\t\tPrograming Fundamental Project\n");
      printf("\t      By Shahzaib Lodhi & Mansoor Ahmed\n");
      for(int s=0;s<=60;s++)
      {
              printf("\4");
      }
      printf("\n \t   1:ADD 2:LIST 3:REMOVE 4:MODIFY 5:EXIT\n");/*Menu*/
      for(int s=0;s<=60;s++)
      {
              printf("\4");
      }
      while(note=='y'||note=='Y')
      {
      printf("\n\nPLEASE SELECT THE MENU NUMBER : ");
      scanf("%d",&smenu);                     
      if(smenu==1)/*add record*/
      {
            
           ab=fopen("addressbook.txt","a+");
           if(ab==NULL)
           {
                puts("Cannot open file");
           }
           gets(aaa.name);
           printf("\n\5 Enter You Name:");
           gets(aaa.name);
           fprintf(ab,"`Name : %s",aaa.name); 
           printf("\n\5 Enter Your Address:");
           gets(aaa.address);
           fprintf(ab,"\nAddress: %s",aaa.address);
           printf("\n\5 Enter Your Email:");
           gets(aaa.email);
           fprintf(ab,"\nEmail: %s",aaa.email);
           printf("\n\5 Enter Your Phone No:");
           gets(aaa.phone);
           fprintf(ab,"\nPhone No: %s",aaa.phone);
           printf("\n\5 Enter Your Mobile No:");
           gets(aaa.mobile);
           fprintf(ab,"\nMobile No: %s\n\n",aaa.mobile);
           printf("\n\n");
           printf("Your Record Has Been Added\n");
           fclose(ab);
           printf("\nPress Y For Menu :");           
           note=getche();
      }
           
           
  
      
      else if(smenu==2)/*LIST*/
      {
           ab = fopen("addressbook.txt", "r");
           while(c1!=EOF){                  
                c1 = fgetc(ab);
                if(c1 == '`'){
                    printf("\nRECORD NUMBER: %d\n", ++count);        
                }
                else{              
                    printf("%c", c1);                                               
                }
            }
            c1 = ' ';
            count = 0;
           fclose(ab);
      }
                  
                  
     
      else if(smenu==3)/*Remove*/
      {
            printf("Enter account number to delete:");
            scanf("%d", &del);
            cd = fopen("temp.txt", "w");
            ab =  fopen("addressbook.txt", "r");
            while(c1!=EOF){                  
                c1 = fgetc(ab);
                if(c1 == '`'){
                    ++count;        
                }
                if(count != del){
                     if(c1 != EOF){    
                           fprintf(cd, "%c", c1);    
                     }
                }
            }            
            fclose(ab);                
            fclose(cd);
            remove("addressbook.txt");
            rename("temp.txt", "addressbook.txt");
            printf("Account deleted");
            c1 = ' ';
            count = 0;
      }   
      else if(smenu==4)/*Edit*/
      {
            printf("Enter account number to edit:");
            scanf("%d", &del);                        
            cd = fopen("temp.txt", "w");
            ab =  fopen("addressbook.txt", "r");
            while(c1!=EOF){                  
                c1 = fgetc(ab);
                if(c1 == '`'){
                    ++count;        
                }
                if(count == del){
                    if(edited == 'n'){     
                       gets(aaa.name);
                       printf("\n\5 Enter New Name:");
                       gets(aaa.name);
                       fprintf(cd,"`Name : %s",aaa.name); 
                       printf("\n\5 Enter New Address:");
                       gets(aaa.address);
                       fprintf(cd,"\nAddress: %s",aaa.address);
                       printf("\n\5 Enter New Email:");
                       gets(aaa.email);
                       fprintf(cd,"\nEmail: %s",aaa.email);
                       printf("\n\5 Enter New Phone No:");
                       gets(aaa.phone);
                       fprintf(cd,"\nPhone No: %s",aaa.phone);
                       printf("\n\5 Enter New Mobile No:");
                       gets(aaa.mobile);
                       fprintf(cd,"\nMobile No: %s\n\n",aaa.mobile);
                       printf("\n\n");
                       edited = 'y';
                    }    
                }
                else if(count != del){
                     if(c1 != EOF){    
                           fprintf(cd, "%c", c1);    
                     }
                }
            }            
            fclose(ab);                
            fclose(cd);
            remove("addressbook.txt");
            rename("temp.txt", "addressbook.txt");
            if(edited == 'y'){
                      printf("Account Edited\n");
            }
            else{
                 printf("Account doesn't exist");     
            }
            c1 = ' ';
            edited = 'n';
            count = 0;
      }
           

      else if(smenu==5)
      {
          fclose(ab);
          return 0;
      }
      getch();
      }
      }
      
