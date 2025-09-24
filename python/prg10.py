#find biggest of 3 numbers
a=int(input("Enter first number: "))
b=int(input("Enter second number: "))
c=int(input("Enter third number: "))
if a>=b and a>=c:
    print(f"{a} is the biggest number")
elif b>=a and b>=c:
    print(f"{b} is the biggest number")
else:
    print(f"{c} is the biggest number")