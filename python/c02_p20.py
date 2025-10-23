#frequency of each character in a string
string=input("enter a string:")
freq={}
for i in string:
    if i in freq:
        freq[i]+=1
    else:
        freq[i]=1
print("frequency of each character in a string is:",freq)
