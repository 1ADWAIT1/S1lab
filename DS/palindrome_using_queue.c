#include<stdio.h>
#include<string.h>
# define MAX 5
int main(){
    int  front = -1,rear=-1, choice, value;
    char queue[MAX];
  printf("enter the value");
  
   for(int i=0;i<MAX;i++){
    scanf("%c", &queue[i]);
  }
  for(int i=0;i<MAX;i++){
    printf("%c", queue[i]);
  }
  return 0;
}
