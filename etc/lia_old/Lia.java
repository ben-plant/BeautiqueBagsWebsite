import java.net.Socket;
import java.net.InetAddress;
import java.io.*;

public class Lia
{
	public static final String JAVABRIDGE_PORT="8087";
	static final php.java.bridge.JavaBridgeRunner runner = php.java.bridge.JavaBridgeRunner.getInstance(JAVABRIDGE_PORT);

	private static final int localPort = 39494;
	private static final String localBrainAddress = "192.168.1.229";

	private Socket brainSocket;

	private ObjectOutputStream oos;
	private ObjectInputStream ois;

	private boolean running;
	private boolean responsePending;

	public static void main(String[] args0) throws Exception
	{
		runner.waitFor();
	}

	public void start()
	{
		try
		{
			InetAddress address = InetAddress.getByName(localBrainAddress);
			brainSocket = new Socket(address, localPort);
			oos = new ObjectOutputStream(brainSocket.getOutputStream());
			oos.flush();
			ois = new ObjectInputStream(brainSocket.getInputStream());
			System.out.println("Client connected!");
			this.running = true;
		}
		catch (IOException e)
		{
			System.out.println("Critical failure! Sad face express.");
			System.exit(-1);
		}
	}

	public String transmit(String input) throws IOException
	{
		while (running)
		{
			this.responsePending = false;
			input = input.toUpperCase();
			try
			{
				oos.writeObject(input);
				oos.flush();
			}
			catch (IOException e)
			{
				e.printStackTrace();
			}
			System.out.println("I said the word " + input);
			this.responsePending = true;
			return new String(obtainResponse());
			exitCleanly();
		}
		return new String("Session terminated");
	}

	public String obtainResponse() throws IOException
	{
		try
		{
			return (String) ois.readObject();
		}
		catch (Exception e)
		{
			e.printStackTrace();
			return null;
		}
	}

	public void exitCleanly() throws IOException
	{
		oos.close();
		ois.close();
		brainSocket.close();
		System.exit(0);
	}
}
