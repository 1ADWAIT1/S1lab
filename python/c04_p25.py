class Time:
    def __init__(self, hours=0, minutes=0, seconds=0):
        self.__hours = hours
        self.__minutes = minutes
        self.__seconds = seconds
        self.__normalize()
    def __normalize(self):
        if self.__seconds >= 60:
            self.__minutes += self.__seconds // 60
            self.__seconds %= 60
        if self.__minutes >= 60:
            self.__hours += self.__minutes // 60
            self.__minutes %= 60
        if self.__hours >= 24:
            self.__hours %= 24
    def display(self):
        print(f"{self.__hours:02d}:{self.__minutes:02d}:{self.__seconds:02d}")
    def __add__(self, other):
        if not isinstance(other, Time):
            return NotImplemented
        new_hours = self.__hours + other.__hours
        new_minutes = self.__minutes + other.__minutes
        new_seconds = self.__seconds + other.__seconds
        return Time(new_hours, new_minutes, new_seconds)
    def get_hours(self):
        return self.__hours
    def get_minutes(self):
        return self.__minutes
    def get_seconds(self):
        return self.__seconds
if __name__ == "__main__":
    t1 = Time(2, 45, 50)
    t2 = Time(1, 30, 30)
    print("Time 1:", end=" ")
    t1.display()
    print("Time 2:", end=" ")
    t2.display()
    t3 = t1 + t2
    print("After addition:", end=" ")
    t3.display()
