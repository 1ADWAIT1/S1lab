#include<stdio.h>
#include<stdlib.h>
struct Node {
        int data;
        struct Node* next;
    };
struct Node* newNode(){
    int value;
    printf("Enter value to insert: ");
    scanf("%d",&value);
    struct Node* newNode = (struct Node*)malloc(sizeof(struct Node));
    newNode->data = value;
    newNode->next = NULL;
    return newNode;
}
void main(){
    struct Node* head = (struct Node*)malloc(sizeof(struct Node));
    head->next = newNode();
    printf("Node created with value: %d\n", head->next->data);
}