package com.example.filipe1309.databetweenactivities_isar;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;


public class Tela2 extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela2);

        Button bt_tela1 = (Button) findViewById(R.id.bt_tela1);
        bt_tela1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), MainActivity.class);
                intent.putExtra("data_with_intent_tela2", "Dados com classe Intent e putExtra, classe Tela2 --> MainActivity(ou qualquer outra acitvity)");
                startActivity(intent);
            }
        });
        TextView tv_intent = (TextView) findViewById(R.id.tv_data_with_intent_tela2);
        Bundle extras = getIntent().getExtras();
        if(extras != null){
            tv_intent.setText(extras.getString("data_with_intent_main"));
        } else {
            tv_intent.setText("No extras from MainActivity");
        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.tela2, menu);
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
