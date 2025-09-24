year1= int(input("enter the starting year:"))
year2= int(input("enter the ending year:"))
for year1 in range(year1+1,year2):
    if(year1%4 ==0 and year1%100!=0) or (year1%400 == 0):
        print(year1)