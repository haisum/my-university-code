#include <stdio.h>
#include <conio.h>
/*
For I = 0 to N - 2
       For J = 0 to N - 2
         If (A(J) > A(J + 1)
           Temp = A(J)
           A(J) = A(J + 1)
           A(J + 1) = Temp
         End-If
       End-For
     End-For
*/
void printarr(int a[6]) {
	int i = 0;
	for(i = 0;i<6;i++) {
	printf("%d,",a[i]);
    }
	printf("\nPress any key to continue.\n");
	getch();
}

void main(){
	int vals[6] = {2, 1, 10, 5, 9, 7 };
	int temp, count=1, i=0, j=0, size=6;
	clrscr();
	printf("Bubble sort:\n");
	printf("Original List:\n");
	printarr(vals);
	for(i =0; i<size-1; i++){
		for(j =0; j<size-1; j++){
			if(vals[j] > vals[j + 1]){
				temp = vals[j];
				vals[j] = vals[j+1];
				vals[j+1] = temp;
			}
			printf("Iteration No.%d: \n", count++);
			printarr(vals);
		}
	}
	getch();
}