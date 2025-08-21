#include<stdio.h>
# define MAX 10
int main(){
    int stack[MAX], top = -1, choice, value;
    while(1){
        printf("Choose an operation:\n");
        printf("1. Push\n2. Pop\n3. Display\n4. Exit\n");
        scanf("%d", &choice);
        switch(choice){
            case 1:
                if(top==MAX-1){
                    printf("Stack Overflow\n");
                }else{
                    printf("Enter the value to push:");
                    scanf("%d", &value);
                    top++;
                    stack[top]=value;
                    printf("Value pushed: %d\n", value);
                }
                break;
            case 2:
                if(top==-1){
                    printf("Stack Underflow\n");
                }else{
                    printf("Value popped: %d\n", stack[top]);
                    top--;}
                break;
            case 3:
                if(top==-1){
                    printf("Stack is empty\n"); 
                }else{
                    printf("Stack elements are:\n");
                    for(int i=top; i>=0; i--){
                        printf("%d\n", stack[i]);
                    }
                }
                break;
            case 4:
                printf("Exiting...\n");
                return 0;
                
            default:
                printf("Invalid choice, please try again.\n");
                
        }
    }
}