#include<stdio.h>
#include<stdlib.h>

// Stack node structure
struct Node {
    int data;
    struct Node* next;
};

// Push function: Adds a new element to the top of the stack
struct Node* push(struct Node* head, int new_data) {
    struct Node* new_node = (struct Node*)malloc(sizeof(struct Node));
    new_node->data = new_data;
    new_node->next = head;  // New node points to the current top node
    return new_node;
}

// Pop function: Removes the top element from the stack
struct Node* pop(struct Node* head) {
    if (head == NULL) {
        printf("Stack underflow. Cannot pop from an empty stack.\n");
        return NULL;
    }
    struct Node* temp = head;
    int popped_data = head->data;
    printf("Popped element: %d\n", popped_data);
    head = head->next;  // Move head to the next element
    free(temp);  // Free the memory of the popped node
    return head;
}

// Main function to interact with the stack
int main() {
    struct Node* head = NULL;
    int choice = 1, value = 0;

    while (1) {
        // Display menu options
        printf("\n1. Push\n");
        printf("2. Pop\n");
        printf("3. Display\n");
        printf("4. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);

        switch (choice) {
            case 1: {
                // Push operation
                printf("Enter value to push: ");
                scanf("%d", &value);
                head = push(head, value);
                break;
            }
            case 2: {
                // Pop operation
                head = pop(head);
                break;
            }
            case 3: {
                // Display stack elements
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
                // Exit program
                printf("Exiting...\n");
                return 0;  // Standard way to exit main
            }
            default: {
                printf("Invalid choice. Please try again.\n");
                break;
            }
        }
    }
}
