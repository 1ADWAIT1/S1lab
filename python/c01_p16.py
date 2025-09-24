#gcd of two numbers
n1=int(input("Enter first number: "))
n2=int(input("Enter second number: "))
while n2!=0:
    r=n1%n2
    n1=n2
    n2=r
print("GCD is",n1)