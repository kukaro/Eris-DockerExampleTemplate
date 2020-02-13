package KafkaProject;

import org.apache.kafka.clients.producer.KafkaProducer;
import org.apache.kafka.clients.producer.Producer;
import org.apache.kafka.clients.producer.ProducerRecord;

import java.util.Properties;

public class App {
    public static void main(String[] args) {
        Properties kafkaProps = new Properties();
        kafkaProps.put("bootstrap.servers", "localhost:9092");
        kafkaProps.put("key.serializer", "org.apache.kafka.common.serialization.StringSerializer");
        kafkaProps.put("value.serializer", "org.apache.kafka.common.serialization.StringSerializer");
        Producer<String, String> producer = new KafkaProducer(kafkaProps);
        System.out.println("hi");
        ProducerRecord<String,String> record = new ProducerRecord<>("test","Precision Products","France2");
        try{
            System.out.println("start");
            producer.send(record);
            System.out.println("end");
        }catch (Exception e){
            e.printStackTrace();
            System.out.println("error");
        }
    }
}
