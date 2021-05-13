import org.apache.hadoop.io.Text;
import org.junit.Test;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;

public class TextTests {
    @Test
    public void textTest() {
        Text t = new Text("hadoop");
        t.set("pig");
        assertThat(t.getLength(), is(3));
        assertThat(t.getBytes().length, is(3));
    }
}
