#include<stdio.h>
int main(){
    struct Node {
        int data;
        struct Node* next;
    };
    struct Node* head = NULL;
    struct Node* tail = NULL;
    int choice, value;
    while(1){
        printf("1. Insert at end\n");
        printf("2. Delete from front\n");
        printf("3. Display\n");
        printf("4. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);
        
        switch(choice) {
            case 1:
                printf("Enter value to insert: ");
                scanf("%d", &value);
                struct Node* newNode = (struct Node*)malloc(sizeof(struct Node));
                newNode->data = value;
                newNode->next = NULL;
                if(head == NULL) {
                    head = newNode;
                    tail = newNode;
                } else {
                    tail->next = newNode;
                    tail = newNode;
                }
                break;
            case 2:
                if(head == NULL) {
                    printf("Queue is empty.\n");
                } else {
                    struct Node* temp = head;
                    head = head->next;
                    printf("Deleted value: %d\n", temp->data);
                    free(temp);
                    if(head == NULL) {
                        tail = NULL;
                    }
                }
                break;
            case 3:
                if(head == NULL) {
                    printf("Queue is empty.\n");
                } else {
                    struct Node* current = head;
                    while(current != NULL) {
                        printf("%d ", current->data);
                        current = current->next;
                    }
                    printf("\n");
                }
                break;
            case 4:
                return 0;
            default:
                printf("Invalid choice, please try again.\n");
        }
    }
}