/** Vending.java
    Emulate a vending machine that sells bus tickets.
    @author    Alice E. Fischer
    @version   January 1, 2012
 */
//  ----------------------------------------------------------------------------
import java.util.*;

public class Vending {
	private final double adult;             // Price of one regular ticket.
	private final double child;             // Child's ticket is half price.
	private final double senior;            // Senior ticket is 80%
	private double totalPrice=0;
	private double totalprice2=0;
	private Scanner sc = new Scanner(System.in);

	/** Initialize a vending machine to sell tickets at a fixed base price. 
	 *     Tickets for children are half price, and seniors are 80%.
	 *  @param price  The base ticket price, for an adult rider.
	 */
	public Vending( double price ){
		adult = price;
		child  = Math.ceil( 100 *( 0.5 * price)) / 100;      // Round the fraction up.
		senior = Math.ceil( 100 *( 0.8 * price)) / 100;      // Round the fraction up.

	}

	/** Dispense bus tickets to be paid for by a credit card. Adult, child, and 
	    senior tickets may be purchased.
	 */
	public void go() {
		double price; // If there is no default below, use   price = 0;
		int choice, quantity;
		int choices;
	    double totalprice2 = 0;

		System.out.println("\nBus Ticket Vending Machine");
		System.out.printf ("    1. Adult %.2f\n    2. Child under (12) %.2f\n", adult, child);
		System.out.printf ("    3. Senior Citizen %.2f\n", senior);
		System.out.printf("     4. Cancel\n");

		for(;;){ 
			System.out.println("Please select 1, 2, 3, 4 .\n");
			choice = sc.nextInt();
			if (choice>0 && choice<5) break;
			String junk = sc.nextLine();   // Discard chars to end of line.
			System.out.printf("Bad menu choice:  %s %s\n", choice, junk);
		}

		for(;;){ 
			if(choice==4) {
				System.out.println("Thankyou for Coming");
				return;
			}
			System.out.println(" enter the quantity.\n");
			quantity = sc.nextInt();

			if (quantity>0 && quantity<10) break;
			String junk1 = sc.nextLine();   // Discard chars to end of line.
			System.out.printf("Bad menu choice:  %s %s\n", quantity, junk1);
		}

		switch (choice){
		case 1: price = adult; break;
		case 2: price = child; break;
		case 3: price = senior; break;
		default: price = 0;   
		}
		totalPrice=quantity *price;
		System.out.printf("Total price: %.2f", totalPrice);
		System.out.println("\nPlease swipe your credit card, then take your tickets.");
		System.out.printf("\n Quantity is = %s",quantity) ; 
		System.out.printf ("\n Ordered Choice is = %s",choice);
		for(;;){
			System.out.println("\n If you want to buy more tickets Press 1 or 2 for Finish and pay.");
			choices=sc.nextInt(); 
			if (choices==1);
			{
				{


					System.out.printf ("    1. Adult %.2f\n    2. Child under (12) %.2f\n", adult, child);
					System.out.printf ("    3. Senior Citizen %.2f\n", senior);
					System.out.printf ("    4. Cancel\n");

					for(;;){ 
						System.out.println("Please select 1, 2, 3, 4 .\n");
						choice = sc.nextInt();
						if (choice>0 && choice<5)break;
						String junk = sc.nextLine();   // Discard chars to end of line.
						System.out.printf("Bad menu choice:  %s %s\n", choice, junk);
					}

					for(;;){ 
						if(choice==4) {
							System.out.println("Thankyou for Coming");
							return;
						}
						System.out.println(" enter the quantity.\n");
						quantity = sc.nextInt();

						if (quantity>0 && quantity<10)break;
						String junk1 = sc.nextLine();   // Discard chars to end of line.
						System.out.printf("Bad menu choice:  %s %s\n", quantity, junk1);
					}
				}


				totalprice2=totalPrice + totalprice2;
				System.out.printf("Total price: %.2f", totalprice2);
				System.out.println("\nPlease swipe your credit card, then take your tickets.");
				System.out.printf("\n Quantity is = %s",quantity) ; 
				System.out.printf ("\n Ordered Choice is = %s",choice);
				
			}

			if(choices==2);
			{ 
				System.out.printf("\n Total price: %.2f",  totalPrice);
				System.out.println("\nPlease swipe your credit card, then take your tickets.");
				return;
				break;
				
			}



		}



		


	

}


	





















	//    -------------------------------------------------------------------------------------------
	public static void main (String args[]) {
		Vending V = new Vending( 2.25 );

		V.go();


	}
}