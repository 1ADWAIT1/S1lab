num=int(input("Enter a number: "))
count=1
n=abs(num)
while n>9:
    count+=1
    n=n//10
print("Number of digits:",count)