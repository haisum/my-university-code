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

void main(){
	int vals[6] = {2, 1, 10, 5, 9, 7 };
	int temp, count=1, i=0, j=0, size=6, smallsub;
	clrscr();
	printf("Selection sort:\n");
	printf("Original List:\n");
	printarr(vals);
	/*For I = 0 to N-1 do:
       Smallsub = I
       For J = I + 1 to N-1 do:
         If A(J) < A(Smallsub)
           Smallsub = J
         End-If
       End-For
       Temp = A(I)
       A(I) = A(Smallsub)
       A(Smallsub) = Temp
     End-For*/
	for(i =0; i<size-1; i++){
		smallsub = i;
		for(j =i+1; j<size; j++){
			if(vals[j] < vals[smallsub]){
				smallsub = j;
			}
		}
		temp = vals[i];
		vals[i] = vals[smallsub];
		vals[smallsub] = temp;		
		printf("Iteration No.%d: \n", count++);
		printarr(vals);
	}
	getch();
}