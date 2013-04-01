/*
some algebra:
x^2 + y^2 = n
x^2 = n-y^2 
x = sqrt(n - y^2)
now algorithm:
for y from 0 to square root of n (since a perfect square of anything can't exceed
								its under root)
if n-y^2  is perfect square
 print "n can be represented as sum of y and sqrt(n-y^2) and is smallest"
 break loop
*/
int isint(float x){
	int i = (int) x;
	if(x-i <0.0000001)//for preciseness due to float
	{
		return 1;
	}
	else
		return 0;
}
int isperfectsqaure(int x){
	return isint(sqrt(x));
}

void main(){
	int test;
	test = isperfectsquare(16);
	printf("%d" , test);
}