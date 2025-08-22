#include <stdio.h>

// User-defined function to calculate factorial
int factorial(int n) {
    int result = 1;
    for(int i = 1; i <= n; i++) {
        result *= i;
    }
    return result;
}

int main() {
    int number;

    // Ask user for input
    printf("Enter a positive integer: ");
    scanf("%d", &number);

    // Input validation
    if (number < 0) {
        printf("Factorial is not defined for negative numbers.\n");
    } else {
        // Call the user-defined function
        int fact = factorial(number);
        printf("Factorial of %d is %d\n", number, fact);
    }

    return 0;
}
