#include<stdio.h>
#include<stdlib.h>
# define MAX 5
typedef struct circularQueue {
    int arr[MAX];
    int front;
    int rear;
} CircularQueue;
void enqueue(CircularQueue* q) {
    if ((q->rear + 1) % MAX == q->front) {
        printf("Queue Overflow\n");             
        return;
    }
    if (q->front == -1) {
        q->front = 0;
    }
    int value;
    printf("Enter value to enqueue: ");
     scanf("%d", &value); 
    q->rear = (q->rear + 1) % MAX;
    q->arr[q->rear] = value;
    printf("Enqueued: %d\n", value);
}
void dequeue(CircularQueue* q) {
    if (q->front == -1) {
        printf("Queue Underflow\n");
        return;
    }
    int dequeued_value = q->arr[q->front];
    if (q->front == q->rear) {
        q->front = q->rear = -1;                 
    } else {
        q->front = (q->front + 1) % MAX;
    }
    printf("Dequeued: %d\n", dequeued_value);
}
display(CircularQueue* q) {
    if (q->front == -1) {
        printf("Queue is empty\n");
        return;
    }
    printf("Queue elements: ");
    int i = q->front;
    while (1) {
        printf("%d ", q->arr[i]);
        if (i == q->rear) {
            break;
        }
        i = (i + 1) % MAX;
    }
    printf("\n");
}
int main() {
    CircularQueue* q = (CircularQueue*)malloc(sizeof(CircularQueue));
    q->front = q->rear = -1;
    int choice = 1;
    while (1) {
        printf("\n1. Enqueue\n");
        printf("2. Dequeue\n");
        printf("3. Display\n");
        printf("4. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);
        switch (choice) {
            case 1:
                enqueue(q);
                break;
            case 2:
                dequeue(q);
                break;
            case 3:
                display(q);
                break;
            case 4:
                printf("Exiting...\n");
                free(q);
                return 0;
            default:
                printf("Invalid choice, please try again.\n");
        }
    }
}