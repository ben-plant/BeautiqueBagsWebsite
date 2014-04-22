
public class Lia
{
	public static final String JAVABRIDGE_PORT="8087";
	static final php.java.bridge.JavaBridgeRunner runner = php.java.bridge.JavaBridgeRunner.getInstance(JAVABRIDGE_PORT);

	public static void main(String[] args0) throws Exception
	{
		runner.waitFor();
	}

	public static String chat(String[] input)
	{
		String output = "The third word was " + input[2];
		return output;
	}
}
