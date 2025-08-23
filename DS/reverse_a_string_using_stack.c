#include<stdio.h>
#include<string.h>
# define MAX 100
int main(){
    char stack[MAX], string[100];
    int top = -1;

                if(top==MAX-1){
                    printf("Stack Overflow\n");
                }else{
                    printf("Enter a string");
                    scanf("%s", &string);
                    for(int i = 0; string[i] != '\0'; i++) {
                        stack[++top] = string[i];
                    }
    }  
    while(1){
    if(top==-1){
                    printf("Stack is empty\n"); 
                }else{
                    printf("Reverse of string:\n");
                    for(int i=top; i>=0; i--){
                        printf("%c", stack[i]);
                    }
                }return 0;
            }
            }