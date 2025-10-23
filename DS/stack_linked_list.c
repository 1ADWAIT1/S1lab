#include<stdio.h>
#include<stdlib.h>
struct Node {
    int data;
    struct Node* next;
};
struct Node* push(struct Node* head, int new_data) {
    struct Node* new_node = (struct Node*)malloc(sizeof(struct Node));
    new_node->data = new_data;
    new_node->next = head;
    return new_node;
}
struct Node* pop(struct Node* head) {
    if (head == NULL) {
        printf("Stack underflow. Cannot pop from an empty stack.\n");
        return NULL;
    }
    struct Node* temp = head;
    int popped_data = head->data;
    printf("Popped element: %d\n", popped_data);
    head = head->next;
    free(temp);
    return head;
}
int main() {
    struct Node* head = NULL;
    int choice = 1, value = 0;

    while (1) {
        printf("\n1. Push\n");
        printf("2. Pop\n");
        printf("3. Display\n");
        printf("4. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);

        switch (choice) {
            case 1: {
                printf("Enter value to push: ");
                scanf("%d", &value);
                head = push(head, value);
                break;
            }
            case 2: {
                head = pop(head);
                break;
            }
            case 3: {
                if (head == NULL) {
                    printf("Stack is empty.\n");
                } else {
                    printf("Stack elements: ");
                    struct Node* ptr = head;
                    while (ptr != NULL) {
                        printf("%d ", ptr->data);
                        ptr = ptr->next;
                    }
                    printf("\n");
                }
                break;
            }
            case 4: {
                
                printf("Exiting...\n");
                return 0;  
            }
            default: {
                printf("Invalid choice. Please try again.\n");
                break;
            }
        }
    }
}
