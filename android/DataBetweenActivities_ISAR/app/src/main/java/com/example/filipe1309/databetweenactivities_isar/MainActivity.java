package com.example.filipe1309.databetweenactivities_isar;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;


public class MainActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        /* Transferencia de dados entre Activities utilizando classe Application*/
        MySuperApplication app = (MySuperApplication) getApplication();
//app.SomeSetting = "Test";
        TextView tv_data = (TextView) findViewById(R.id.tv_data_with_app);
        tv_data.setText(app.SomeSetting);
/* Tranferencia de dados entre Activities utilizando Intent*/
        Button bt_tela2 = (Button) findViewById(R.id.bt_tela2);
        bt_tela2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(),Tela2.class);
                intent.putExtra("data_with_intent_main", "Dados com classe Intent e putExtra, classe MainActivity --> Tela2 (ou qualquer outra acitvity)");
                startActivity(intent);
            }
        });
        TextView tv_intent = (TextView) findViewById(R.id.tv_data_with_intent);
        Bundle extras = getIntent().getExtras();
        if(extras != null) {
            tv_intent.setText(extras.getString("data_with_intent_tela2"));
        } else {
            tv_intent.setText("No extras from Tela2");
        }
/* Tranferencia de dados entre Activities utilizando Singleton*/
        TextView tv_singleton = (TextView) findViewById(R.id.tv_data_with_singleton);
        tv_singleton.setText(Singleton.getInstance().getString());
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}
