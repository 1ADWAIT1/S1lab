n=int(input("enter a number"))
n1=0
n2=1
print("Fibonacci series:\n")
for i in range(n):
    print(n1,end=",")
    n3=n1+n2
    n1=n2
    n2=n3
print("...")