package cyanon.lia;

import java.io.Serializable;

public class TransportPacket implements Serializable {

	private static final long serialVersionUID = 1L;
	public String payload;

	public TransportPacket(String input)
	{
		this.payload = input;
	}
}
