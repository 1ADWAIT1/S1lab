#include <stdio.h>
#include <stdlib.h>

struct Node {
    int data;
    struct Node* next;
    struct Node* prev;
};

struct Node* newNode() {
    int value;
    printf("Enter value to insert: ");
    scanf("%d", &value);
    struct Node* newNode = (struct Node*)malloc(sizeof(struct Node));
    newNode->data = value;
    newNode->next = NULL;
    newNode->prev = NULL;
    return newNode;
}

struct Node* inend(struct Node* head) {
    struct Node* newNode1 = newNode();
    if (head == NULL) {
        head = newNode1;
        newNode1->next = head;
        newNode1->prev = head;
    } else {
        struct Node* ptr = head;
        while (ptr->next != head) {  
            ptr = ptr->next;
        }
        ptr->next = newNode1;
        newNode1->prev = ptr;
        newNode1->next = head;
        head->prev = newNode1;
    }
    return head;
}

struct Node* infront(struct Node* head) {
    struct Node* newNode1 = newNode();
    if (head == NULL) {
        head = newNode1;
        newNode1->next = head;
        newNode1->prev = head;
    } else {
        newNode1->next = head;
        newNode1->prev = head->prev;
        head->prev->next = newNode1;
        head->prev = newNode1;
        head = newNode1;
    }
    return head;
}

int main() {
    struct Node* head = NULL;
    int choice = 1;
    while (1) {
        printf("1. Insert at end\n");
        printf("2. Insert at front\n");
        printf("3. Insert at position\n");
        printf("4. Delete from front\n");
        printf("5. Delete from end\n");
        printf("6. Delete from position\n");
        printf("7. Display\n");
        printf("8. Search\n");
        printf("9. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);

        switch (choice) {
            case 1: {
                head = inend(head);     
                break;
            }
            case 2: {
                head = infront(head);
                break;
            }
            case 3: {
                int pos;
                printf("Enter position to insert at: ");
                scanf("%d", &pos);
                struct Node* newNode1 = newNode();
                if (pos == 0) {
                    head = infront(head);
                } else {
                    struct Node* ptr = head;
                    for (int i = 0; i < pos - 1 && ptr != NULL; i++) {
                        ptr = ptr->next;
                    }
                    if (ptr == NULL) {
                        printf("Position out of bounds. Inserting at end.\n");
                        head = inend(head);
                    } else {
                        newNode1->next = ptr->next;
                        if (ptr->next != NULL) {
                            ptr->next->prev = newNode1;
                        }
                        ptr->next = newNode1;
                        newNode1->prev = ptr;
                    }
                }
                break;    
            }
            case 4: {
                if (head == NULL) {
                    printf("List is empty. Cannot delete.\n");
                } else if (head->next == head) {
                    free(head);
                    head = NULL;
                } else {
                    struct Node* temp = head;
                    head->prev->next = head->next;
                    head->next->prev = head->prev;
                    head = head->next;
                    free(temp);
                }
                break;
            }
            case 5: {
                if (head == NULL) {
                    printf("List is empty. Cannot delete.\n");
                } else if (head->next == head) {
                    free(head);
                    head = NULL;
                } else {
                    struct Node* temp = head->prev;
                    head->prev = temp->prev;
                    temp->prev->next = head;
                    free(temp);
                }
                break;
            }
            case 6: {
                int pos;
                printf("Enter position to delete from: ");
                scanf("%d", &pos);
                if (head == NULL) {
                    printf("List is empty. Cannot delete.\n");
                } else {
                    struct Node* ptr = head;
                    for (int i = 0; i < pos && ptr != head; i++) {
                        ptr = ptr->next;
                    }
                    if (ptr == head) {
                        printf("Position out of bounds. Cannot delete.\n");
                    } else {
                        ptr->prev->next = ptr->next;
                        if (ptr->next != NULL) {
                            ptr->next->prev = ptr->prev;
                        }
                        free(ptr);
                    }
                }
                break;
            }
            case 7: {
                if (head == NULL) {
                    printf("List is empty.\n");
                } else {
                    printf("List elements: ");
                    struct Node* ptr = head;
                    do {
                        printf("%d ", ptr->data);
                        ptr = ptr->next;
                    } while (ptr != head);  
                    printf("\n");
                }
                break;
            }
            case 8: {
                if (head == NULL) {
                    printf("List is empty.\n");
                } else {
                    int value;
                    printf("Enter value to search: ");
                    scanf("%d", &value);
                    struct Node* ptr = head;
                    int found = 0;
                    do {
                        if (ptr->data == value) {
                            printf("Value %d found in the list.\n", value);
                            found = 1;
                            break;
                        }
                        ptr = ptr->next;
                    } while (ptr != head);
                    if (!found) {
                        printf("Value %d not found in the list.\n", value);
                    }
                }
                break;
            }
            case 9: {
                printf("Exiting...\n");
                return 0;
            }
            default: {
                printf("Invalid choice. Please try again.\n");
                break;
            }
        }
    }
    return 0;
}
