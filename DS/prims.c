#include <stdio.h>
#include <stdlib.h>
#include <limits.h>
#define INF INT_MAX
int minKey(int key[], int mstSet[], int vertices) {
    int min = INF, min_index;
    for (int v = 0; v < vertices; v++)
        if (mstSet[v] == 0 && key[v] < min) {
            min = key[v];
            min_index = v;
        }
    return min_index;
}
void printMST(int parent[], int **graph, int vertices) {
    printf("Edge \tWeight\n");
    for (int i = 1; i < vertices; i++)
        printf("%d - %d \t%d\n", parent[i], i, graph[i][parent[i]]);
}
void primMST(int **graph, int vertices) {
    int parent[vertices];
    int key[vertices];
    int mstSet[vertices];
    for (int i = 0; i < vertices; i++) {
        key[i] = INF;
        mstSet[i] = 0;
    }
    key[0] = 0;
    parent[0] = -1;
    for (int count = 0; count < vertices - 1; count++) {
        int u = minKey(key, mstSet, vertices);
        mstSet[u] = 1;
        for (int v = 0; v < vertices; v++)
            if (graph[u][v] && mstSet[v] == 0 && graph[u][v] < key[v]) {
                parent[v] = u;
                key[v] = graph[u][v];
            }
    }
    printMST(parent, graph, vertices);
}
int main() {
    int vertices = 5;
    int **graph = (int **)malloc(vertices * sizeof(int *));
    for (int i = 0; i < vertices; i++) {
        graph[i] = (int *)malloc(vertices * sizeof(int));
    }
    int graphData[5][5] = {
        {0, 2, 0, 6, 0},
        {2, 0, 3, 8, 5},
        {0, 3, 0, 0, 7},
        {6, 8, 0, 0, 9},
        {0, 5, 7, 9, 0}
    };
    for (int i = 0; i < vertices; i++)
        for (int j = 0; j < vertices; j++)
            graph[i][j] = graphData[i][j];
    printf("Prim's Minimum Spanning Tree:\n");
    primMST(graph, vertices);
    for (int i = 0; i < vertices; i++)
        free(graph[i]);
    free(graph);
    return 0;
}
