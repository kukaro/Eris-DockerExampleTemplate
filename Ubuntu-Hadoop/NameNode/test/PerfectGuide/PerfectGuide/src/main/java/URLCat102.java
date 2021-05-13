import org.apache.hadoop.fs.FsUrlStreamHandlerFactory;
import org.apache.hadoop.io.IOUtils;

import java.io.IOException;
import java.io.InputStream;
import java.net.URL;

public class URLCat102 {

    static {
        URL.setURLStreamHandlerFactory(new FsUrlStreamHandlerFactory());
    }

    public static void main(String[] args) throws IOException {
        InputStream in = null;
        in = new URL(args[0]).openStream();
        IOUtils.copyBytes(in, System.out, 4096, false);
        System.out.println("!!!!!" + in + "!!!!!");
        IOUtils.closeStream(in);
    }
}
