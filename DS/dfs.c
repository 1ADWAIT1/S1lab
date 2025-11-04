#include <stdio.h>
#include <stdlib.h>
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
void DFS(struct Graph* graph, int vertex) {
    graph->visited[vertex] = 1;
    printf("%d ", vertex);
    for (int i = 0; i < graph->numVertices; i++) {
        if (graph->adjMatrix[vertex][i] == 1 && graph->visited[i] == 0) {
            DFS(graph, i);
        }
    }
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
    printf("DFS Traversal starting from vertex 0: ");
    DFS(graph, 0);
    printf("\n");
    return 0;
}