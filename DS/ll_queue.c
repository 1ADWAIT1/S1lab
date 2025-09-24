#include<stdio.h>
#include<stdlib.h>
typedef struct Node {
    int data;
    struct Node* next;
} Node;
typedef struct Queue {
    struct Node* front;
    struct Node* rear;
} Queue;
 Node* newNode(){
    int value;
    printf("Enter value to insert: ");
    scanf("%d", &value);
    struct Node* newNode = (struct Node*)malloc(sizeof(struct Node));
    newNode->data = value;
    newNode->next = NULL;
    return newNode;
}
Queue* createQueue() {
    Queue* q = (Queue*)malloc(sizeof(Queue));
    q->front = q->rear = NULL;
    return q;
}
enqueue(Queue* q, Node* newNode) {
    if (q->rear == NULL) {
        q->front = q->rear = newNode;
        return;
    }
    q->rear->next = newNode;
    q->rear = newNode;
}
dequeue(Queue* q) {
    if (q->front == NULL) {
        printf("Queue underflow. Cannot dequeue from an empty queue.\n");
        return;
    }
    Node* temp = q->front;
    int dequeued_data = q->front->data;
    printf("Dequeued element: %d\n", dequeued_data);
    q->front = q->front->next;
    if (q->front == NULL) {
        q->rear = NULL;
    }
    free(temp);
}
int main(){
    Queue* q = createQueue();
    int choice=1;
    
    while(1){
        printf("\n1. Enqueue\n");
        printf("2. Dequeue\n");
        printf("3. Display\n");
        printf("4. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);
        switch (choice) {
            case 1:{
                enqueue(q, newNode());
                break;
            }
            case 2:{
                dequeue(q);
                break;
            }
            case 3:{ 
                if (q->front == NULL) {
                    printf("Queue is empty.\n");
                } else {
                    printf("Queue elements: ");
                    Node* ptr = q->front;
                    while (ptr != NULL) {
                        printf("%d ", ptr->data);
                        ptr = ptr->next;
                    }
                    printf("\n");
                }
                break;
            } 
            case 4:{
                printf("Exiting...\n");
                return 0;
            }
            default:{
                printf("Invalid choice. Please try again.\n");
                break;
            }
        }
    }
    return 0;
}