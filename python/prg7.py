l=input("Enter the first list of integers separated by spaces: ").split()
l1=[int(i) for i in l]
l=input("Enter the second list of integers separated by spaces: ").split()
l2=[int(i) for i in l]
#whether list are of same length
if len(l1)!=len(l2):
    print("Lists are of different lengths.")
else:
    print("Lists are of same lengths.")
#whether list sums to same value
if sum(l1)!=sum(l2):
    print("Lists sum to different values.")
else:
    print("Lists sum to same value.")
#whether any value occurs in both
common=False
for i in l1:
    if i in l2:
        common=True
        break
if common:
    print("Lists have common values.")
else:
    print("Lists have no common values.")