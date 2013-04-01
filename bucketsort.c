#include <stdio.h>
#include <conio.h>
void printarr(int a[6]) {
	int i = 0;
	for(i = 0;i<6;i++) {
	printf("%d,",a[i]);
    }
	printf("\nPress any key to continue.\n");
	getch();
}

void bucketSort(int array[6]) {
  int i, j, n =6;
  int count[6];
  for(i=0; i < n; i++) {
    count[i] = 0;
  }

  for(i=0; i < n; i++) {
    (count[array[i]])++;
  }

  for(i=0,j=0; i < n; i++) {
    for(; count[i]>0; (count[i])--) {
      array[j++] = i;
    }
  }

}

void main(){
	int vals[6] = {2, 1, 10, 5, 9, 7 };
	clrscr();
	printf("Bucket sort:\n");
	printf("Original List:\n");
	printarr(vals);
	bucketsort(vals);	
	printf("After bucket sort:\n");
	printarr(vals);
	getch();
}