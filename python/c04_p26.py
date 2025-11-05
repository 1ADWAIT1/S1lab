class Publisher:
    def __init__(self, name):
        self.name = name
    def display(self):
        print(f"Publisher: {self.name}")
class Book(Publisher):
    def __init__(self, name, title, author):
        super().__init__(name)
        self.title = title
        self.author = author
    def display(self):
        super().display()
        print(f"Title: {self.title}")
        print(f"Author: {self.author}")
class Python(Book):
    def __init__(self, name, title, author, price, pages):
        super().__init__(name, title, author)
        self.price = price
        self.pages = pages
    def display(self):
        super().display()
        print(f"Price: ₹{self.price}")
        print(f"Pages: {self.pages}")
if __name__ == "__main__":
    p = Python("O'Reilly Media", "Learning Python", "Mark Lutz", 950, 1648)
    print("\nBook Details:")
    p.display()