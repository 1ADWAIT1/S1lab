#include <stdio.h>
#include <stdlib.h>
struct Node {
    int vertex;
    struct Node* next;
};
struct Graph {
    int numVertices;
    struct Node** adjLists;
    int* visited;
};
struct Node* createNode(int v) {
    struct Node* newNode = (struct Node*)malloc(sizeof(struct Node));
    newNode->vertex = v;
    newNode->next = NULL;
    return newNode;
}
struct Graph* createGraph(int vertices) {
    struct Graph* graph = (struct Graph*)malloc(sizeof(struct Graph));
    graph->numVertices = vertices;
    graph->adjLists = (struct Node**)malloc(vertices * sizeof(struct Node*));
    graph->visited = (int*)malloc(vertices * sizeof(int));
    for (int i = 0; i < vertices; i++) {
        graph->adjLists[i] = NULL;
        graph->visited[i] = 0;
    }
    return graph;
}
void addEdge(struct Graph* graph, int src, int dest) {
    struct Node* newNode = createNode(dest);
    newNode->next = graph->adjLists[src];
    graph->adjLists[src] = newNode;
}
void topologicalSortUtil(struct Graph* graph, int v, int* stack, int* top) {
    graph->visited[v] = 1;
    struct Node* temp = graph->adjLists[v];
    while (temp) {
        int adjVertex = temp->vertex;
        if (!graph->visited[adjVertex])
            topologicalSortUtil(graph, adjVertex, stack, top);
        temp = temp->next;
    }
    stack[++(*top)] = v;
}
void topologicalSort(struct Graph* graph) {
    int* stack = (int*)malloc(graph->numVertices * sizeof(int));
    int top = -1;
    for (int i = 0; i < graph->numVertices; i++) {
        if (!graph->visited[i])
            topologicalSortUtil(graph, i, stack, &top);
    }
    printf("Topological Sort: ");
    while (top >= 0)
        printf("%d ", stack[top--]);
    printf("\n");
}
int main() {
    int vertices = 6;
    struct Graph* graph = createGraph(vertices);
    addEdge(graph, 5, 0);
    addEdge(graph, 5, 2);
    addEdge(graph, 4, 0);
    addEdge(graph, 4, 1);
    addEdge(graph, 2, 3);
    addEdge(graph, 3, 1);
    topologicalSort(graph);
    return 0;
}