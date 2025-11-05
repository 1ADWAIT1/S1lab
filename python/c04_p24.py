class BankAccount:
    def __init__(self, account_number, account_holder, password, balance=0):
        self.account_number = account_number
        self.account_holder = account_holder
        self.password = password 
        self.balance = balance
        print(f"\nAccount created for {self.account_holder} (Acc No: {self.account_number}) with balance ₹{self.balance}\n")
    def verify_password(self, entered_password):
        return entered_password == self.password
    def deposit(self, amount):
        if amount > 0:
            self.balance += amount
            print(f" Deposited ₹{amount}. New balance: ₹{self.balance}")
        else:
            print(" Deposit amount must be positive!")
    def withdraw(self, amount):
        if 0 < amount <= self.balance:
            self.balance -= amount
            print(f"Withdrew ₹{amount}. Remaining balance: ₹{self.balance}")
        else:
            print("Insufficient balance or invalid amount!")
    def check_balance(self):
        print(f" Account [{self.account_number}] - Holder: {self.account_holder}, Balance: ₹{self.balance}")
accounts = {}
while True:
    print("\n====  Bank Menu ====")
    print("1. Create Account")
    print("2. Deposit Money")
    print("3. Withdraw Money")
    print("4. Check Balance")
    print("5. Exit")
    choice = input("Enter your choice (1-5): ")
    if choice == "1":
        acc_no = input("Enter new account number: ")
        if acc_no in accounts:
            print(" Account number already exists!")
        else:
            name = input("Enter account holder name: ")
            password = input("Set a password for your account: ")
            balance = float(input("Enter initial deposit: "))
            accounts[acc_no] = BankAccount(acc_no, name, password, balance)
    elif choice in ["2", "3", "4"]:
        acc_no = input("Enter your account number: ")
        if acc_no in accounts:
            entered_password = input("Enter your password: ")
            if accounts[acc_no].verify_password(entered_password):
                if choice == "2":
                    amount = float(input("Enter amount to deposit: "))
                    accounts[acc_no].deposit(amount)
                elif choice == "3":
                    amount = float(input("Enter amount to withdraw: "))
                    accounts[acc_no].withdraw(amount)

                elif choice == "4":
                    accounts[acc_no].check_balance()
            else:
                print("Incorrect password!")
        else:
            print(" Account not found!")
    elif choice == "5":
        print("Thank you for banking with us!")
        break
    else:
        print("Invalid choice! Please try again.")