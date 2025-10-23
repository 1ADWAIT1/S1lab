#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>

#define INITIAL_CAPACITY 10

typedef struct {
    int *data;
    int size;
    int capacity;
} Set;

Set make_set() {
    Set s;
    s.data = malloc(INITIAL_CAPACITY * sizeof(int));
    s.size = 0;
    s.capacity = INITIAL_CAPACITY;
    return s;
}


bool contains(Set *set, int value) {
    for (int i = 0; i < set->size; i++) {
        if (set->data[i] == value) return true;
    }
    return false;
}

void add(Set *set, int value) {
    if (!contains(set, value)) {
        if (set->size == set->capacity) {
            set->capacity *= 2;
            set->data = realloc(set->data, set->capacity * sizeof(int));
        }
        set->data[set->size++] = value;
    }
}

void get_set(Set *set) {
    printf("{ ");
    for (int i = 0; i < set->size; i++) {
        printf("%d ", set->data[i]);
    }
    printf("}\n");
}

Set union_set(Set *a, Set *b) {
    Set result = make_set();

    for (int i = 0; i < a->size; i++) {
        add(&result, a->data[i]);
    }

    for (int i = 0; i < b->size; i++) {
        add(&result, b->data[i]);
    }

    return result;
}


void free_set(Set *set) {
    free(set->data);
    set->data = NULL;
    set->size = 0;
    set->capacity = 0;
}

void input_set(Set *set, char set_name) {
    int n, val;
    printf("Enter number of elements for Set %c: ", set_name);
    scanf("%d", &n);

    printf("Enter %d elements (duplicates will be ignored):\n", n);
    for (int i = 0; i < n; i++) {
        scanf("%d", &val);
        add(set, val);
    }
}

int main() {
    Set setA = make_set();
    Set setB = make_set();

    input_set(&setA, 'A');
    input_set(&setB, 'B');

    printf("Set A: ");
    get_set(&setA);

    printf("Set B: ");
    get_set(&setB);

    Set unionAB = union_set(&setA, &setB);
    printf("Union of A and B: ");
    get_set(&unionAB);


    free_set(&setA);
    free_set(&setB);
    free_set(&unionAB);

    return 0;
}
