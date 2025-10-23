# sort dictionary in ascending and descending order by value without using built-in functions
def sort(d, ascending=True):
    items = list(d.items())
    n = len(items)
    for i in range(n):
        for j in range(0, n-i-1):
            if (ascending and items[j][1] > items[j+1][1]) or (not ascending and items[j][1] < items[j+1][1]):
                items[j], items[j+1] = items[j+1], items[j]
    sorted_dict = {}
    for key, value in items:
        sorted_dict[key] = value

    return sorted_dict

dictionary = {'apple': 5, 'banana': 2, 'orange': 8, 'grape': 1}
print("Dictionary in Ascending order:", sort(dictionary))
print("Dictionary in Descending order:", sort(dictionary,False))