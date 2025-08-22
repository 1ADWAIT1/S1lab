#include<stdio.h>
# define MAX 5
int main(){
    int queue[MAX], front = -1,rear=-1, choice, value;
    while(1){
        printf("Choose an operation:\n");
        printf("1. Insertion\n2. Deletion\n3. Display\n4. Exit\n");
        scanf("%d", &choice);
        switch(choice){
            case 1:
                if(rear==MAX-1){
                    printf("Overflow\n");
                }else{
                    printf("Enter the value to insert:");
                    scanf("%d", &value);
                    if(front==-1){
                        front=0;
                    }
                    rear++;
                    queue[rear]=value;
                    printf("Value inserted: %d\n", value);
                }
                break;
            case 2:
                if(front==-1){
                    printf("Underflow\n");
                }else{
                    printf("Value deleted: %d\n", queue[front]);
                    front++;
                    if(front > rear){
                        front = rear = -1; 
                    }
                }
                break;
            case 3:
                if(front==-1){
                    printf("queue is empty\n"); 
                }else{
                    printf("queue elements are:\n");
                    for(int i=front; i<=rear; i++){
                        printf("%d\n", queue[i]);
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