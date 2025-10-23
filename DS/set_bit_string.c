//set using bit strings
#include <stdio.h>
#include <stdlib.h>
#define UNIVERSE_SIZE 8
typedef unsigned int Set;
void displaySet(Set s);
Set addElement(Set s, int elem);
Set removeElement(Set s, int elem);
int isMember(Set s, int elem);
Set setUnion(Set a, Set b);
Set setIntersection(Set a, Set b);
Set setDifference(Set a, Set b);
Set setComplement(Set a);
void displaySet(Set s) {
    printf("{ ");
    for (int i = 0; i < UNIVERSE_SIZE; i++) {
        if (s & (1 << i))
            printf("%d ", i);
    }
    printf("}");
}
Set addElement(Set s, int elem) {
    if (elem >= 0 && elem < UNIVERSE_SIZE)
        s |= (1 << elem);
    return s;
}
Set removeElement(Set s, int elem) {
    if (elem >= 0 && elem < UNIVERSE_SIZE)
        s &= ~(1 << elem);
    return s;
}
int isMember(Set s, int elem) {
    if (elem >= 0 && elem < UNIVERSE_SIZE)
        return (s & (1 << elem)) != 0;
    return 0;
}
Set setUnion(Set a, Set b) {
    return a | b;
}
Set setIntersection(Set a, Set b) {
    return a & b;
}
Set setDifference(Set a, Set b) {
    return a & (~b);
}
Set setComplement(Set a) {
    Set mask = (1 << UNIVERSE_SIZE) - 1;
    return (~a) & mask;
}
int main() {
    Set A = 0, B = 0;
    int choice, elem;

    while (1) {
        printf("\n\n--- SET OPERATIONS USING BIT STRINGS ---\n");
        printf("1. Add element to Set A\n");
        printf("2. Add element to Set B\n");
        printf("3. Display Sets\n");
        printf("4. Union (A ∪ B)\n");
        printf("5. Intersection (A ∩ B)\n");
        printf("6. Difference (A - B)\n");
        printf("7. Complement of A\n");
        printf("8. Check membership in A\n");
        printf("9. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);
        switch (choice) {
            case 1:
                printf("Enter element to add to A (0–%d): ", UNIVERSE_SIZE - 1);
                scanf("%d", &elem);
                A = addElement(A, elem);
                break;
            case 2:
                printf("Enter element to add to B (0–%d): ", UNIVERSE_SIZE - 1);
                scanf("%d", &elem);
                B = addElement(B, elem);
                break;
            case 3:
                printf("Set A = "); displaySet(A);
                printf("\nSet B = "); displaySet(B);
                break;
            case 4:
                printf("A ∪ B = "); displaySet(setUnion(A, B));
                break;
            case 5:
                printf("A ∩ B = "); displaySet(setIntersection(A, B));
                break;
            case 6:
                printf("A - B = "); displaySet(setDifference(A, B));
                break;
            case 7:
                printf("Complement of A = "); displaySet(setComplement(A));
                break;
            case 8:
                printf("Enter element to check: ");
                scanf("%d", &elem);
                if (isMember(A, elem))
                    printf("%d is in A.\n", elem);
                else
                    printf("%d is not in A.\n", elem);
                break;
            case 9:
                return 0;
            default:
                printf("Invalid choice!\n");
        }
    }
    return 0;
}
