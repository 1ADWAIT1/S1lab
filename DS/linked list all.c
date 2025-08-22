#include<stdio.h>
struct Node {
        int data;
        struct Node* next;
    };
int *traversal(int value,int *ptr,int choice){
    int k=-1;
        while(ptr!=NULL){k=1;
            ptr=ptr->next;
            if(choice==1){
                printf("%d ",ptr->data);
                k++;
            }
            else if(choice==2){
                if(ptr->data==value){
                    printf("Value %d found in the list.\n", value);
                    k=0;
                    return ptr;
                }}
                if(k=1){
                    printf("Value %d not found in the list.\n", value);
                    return NULL;
                }
if (k==-1){
    printf("List is empty.\n");
    return NULL;
}
                return ptr;
            

        }
    }
struct newNode(){
    printf("Enter value to insert: ");
                scanf("%d", &value);
    struct Node* newNode = (struct Node*)malloc(sizeof(struct Node));
    newNode->data = value;
    newNode->next = NULL;
    return newNode;
}
int main(){
    
    struct Node* head = NULL;
    int choice, value=0;
    while(1){
        printf("1. Insert at end\n");
        printf("2. Insert at front\n");
        printf("3. Insert at position\n")
        printf("4. Delete from front\n");
        printf("5. Delete from end\n");
        printf("6. Delete from position\n");
        printf("7. Display\n");
        printf("8. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);
        switch (choice){
            case 1:{
                
                struct Node* newNode = newNode();
                if(head == NULL) {
                    head = newNode;
               }
               else{
                traversal(value,head,1)->next=newNode;
               }
               break;
        }
        case 2:{
            struct Node* newNode = newNode();
            here:
            if(head == NULL) {
                head = newNode;
           }
           else{
            newNode->next=head;
            head=newNode;
           }
           break;
        }
        case 3:{
            int pos;
            printf("Enter position to insert at: ");
            scanf("%d", &pos);
            struct Node* newNode = newNode();
            if(pos==0){
                goto here;
            }
            else{
                struct Node* ptr=head;
                for(int i=0;i<pos-1;i++){
                    if(ptr==NULL){
                        printf("Position out of bounds. Inserting at end.\n");
                        break;
                    }
                    ptr=ptr->next;
                }
                newNode->next=ptr->next;
                ptr->next=newNode;
            }

        }
        case 4:{
            if(head == NULL) {
                printf("List is empty. Cannot delete.\n");
            } 
            else {
                struct Node* temp = head;
                head = head->next;
                free(temp);
            }
            break;
        }case 7:{
            if(head == NULL) {
                printf("List is empty.\n");
            } 
            else {
                printf("List elements: ");
                traversal(value,head,1);
                printf("\n");
            }
            break;

            case 8:{
                exit(0);
            }
        }

        