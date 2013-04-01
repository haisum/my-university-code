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

void quicksort(int list[],int m,int n)
{
   int key,i,j,k, temp;
   if( m < n)
   {
      k = (m + n)/2;
	  temp = list[m];
	  list[m] = list[k];
	  list[k] = temp;
      key = list[m];
      i = m+1;
      j = n;
      while(i <= j)
      {
         while((i <= n) && (list[i] <= key))
                i++;
         while((j >= m) && (list[j] > key))
                j--;
         if( i < j){						
				  temp = list[i];
				  list[i] = list[j];
				  list[j] = temp;				
				}
      }
	  // swap two elements
      
	  temp = list[m];
	  list[m] = list[j];
	  list[j] = temp;
	  // recursively sort the lesser list
      quicksort(list,m,j-1);
      quicksort(list,j+1,n);
   }
}

void main(){
	int vals[6] = {2, 1, 10, 5, 9, 7 };
	int temp, count=1, i=0, j=0, size=6, smallsub;
	clrscr();
	printf("QUICK sort:\n");
	printf("Original List:\n");
	printarr(vals);
	quicksort(vals, 0, 6-1);	
	printf("After quick sort:\n");
	printarr(vals);
	getch();
}