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

void radixsort(int a[6])
{

	int i,b[6],m=0,exp=1, n =6;
	int bucket[10]={0};
	for(i=0;i<n;i++)
	{
		if(a[i]>m)
			m=a[i];
	}
	
	while(m/exp>0)
	{
		bucket[0]=0;
		for(i=0;i<n;i++)
			bucket[a[i]/exp%10]++;
		for(i=1;i<10;i++)
			bucket[i]+=bucket[i-1];
		for(i=n-1;i>=0;i--)
			b[--bucket[a[i]/exp%10]]=a[i];
		for(i=0;i<n;i++)
			a[i]=b[i];
		exp*=10;	
	}
}

void main(){
	int vals[6] = {2, 1, 10, 5, 9, 7 };
	clrscr();
	printf("Bucket sort:\n");
	printf("Original List:\n");
	printarr(vals);
	radixsort(vals);	
	printf("After bucket sort:\n");
	printarr(vals);
	getch();
}