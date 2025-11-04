#include <stdio.h>
#include <stdlib.h>
#define MAX 100 
struct Queue {
    int items[MAX];
    int front;
    int rear;
};
void initQueue(struct Queue *q) {
    q->front = -1;
    q->rear = -1;
}
int isEmpty(struct Queue *q) {
    return q->rear == -1;
}
void enqueue(struct Queue *q, int value) {
    if (q->rear == MAX - 1)
        printf("Queue is full!\n");
    else {
        if (q->front == -1)
            q->front = 0;
        q->rear++;
        q->items[q->rear] = value;
    }
}
int dequeue(struct Queue *q) {
    int item;
    if (isEmpty(q)) {
        printf("Queue is empty!\n");
        return -1;
    } else {
        item = q->items[q->front];
        q->front++;
        if (q->front > q->rear) {
            q->front = q->rear = -1;
        }
        return item;
    }
}
struct Graph {
    int numVertices;
    int **adjMatrix;
    int *visited;
};
struct Graph* createGraph(int vertices) {
    struct Graph* graph = (struct Graph*)malloc(sizeof(struct Graph));
    graph->numVertices = vertices;
    graph->adjMatrix = (int**)malloc(vertices * sizeof(int*));
    graph->visited = (int*)malloc(vertices * sizeof(int));
    for (int i = 0; i < vertices; i++) {
        graph->adjMatrix[i] = (int*)malloc(vertices * sizeof(int));
        graph->visited[i] = 0;
        for (int j = 0; j < vertices; j++)
            graph->adjMatrix[i][j] = 0;
    }
    return graph;
}
void addEdge(struct Graph* graph, int src, int dest) {
    graph->adjMatrix[src][dest] = 1;
    graph->adjMatrix[dest][src] = 1;
}
void BFS(struct Graph* graph, int startVertex) {
    struct Queue q;
    initQueue(&q);
    graph->visited[startVertex] = 1;
    enqueue(&q, startVertex);
    printf("BFS Traversal: ");
    while (!isEmpty(&q)) {
        int currentVertex = dequeue(&q);
        printf("%d ", currentVertex);

        for (int i = 0; i < graph->numVertices; i++) {
            if (graph->adjMatrix[currentVertex][i] == 1 && graph->visited[i] == 0) {
                graph->visited[i] = 1;
                enqueue(&q, i);
            }
        }
    }
    printf("\n");
}
int main() {
    int vertices = 6;
    struct Graph* graph = createGraph(vertices);
    addEdge(graph, 0, 1);
    addEdge(graph, 0, 2);
    addEdge(graph, 1, 3);
    addEdge(graph, 1, 4);
    addEdge(graph, 2, 4);
    addEdge(graph, 3, 4);
    addEdge(graph, 3, 5);
    BFS(graph, 0);
    return 0;
}