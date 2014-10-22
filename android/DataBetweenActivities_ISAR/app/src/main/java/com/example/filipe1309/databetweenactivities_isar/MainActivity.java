package com.example.filipe1309.databetweenactivities_isar;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;


public class MainActivity extends Activity {

    static final int NEW_ACTIVITY_REQUEST = 0;
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

        Button bt_tela3 = (Button) findViewById(R.id.bt_tela3);
        bt_tela3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getBaseContext(), Tela3.class);
                startActivityForResult(intent, NEW_ACTIVITY_REQUEST );
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        // Se retornou da activity chamada
        if (requestCode == NEW_ACTIVITY_REQUEST) {
            // Se o código retornado foi OK
            if (resultCode == RESULT_OK){
                String value = (String) data.getExtras().getString("valorSetResult");
                Toast.makeText(this, "Retornou da Tela 3 - resultCode", Toast.LENGTH_SHORT).show();
                TextView tv_data_with_saResult = (TextView) findViewById(R.id.tv_data_with_saResult);
                tv_data_with_saResult.setText("Retornou da Tela 3 no método onActivityResult, " +
                        "com requestCode == NEW_ACTIVITY_REQUEST,\n e resultCode == RESULT_OK, através" +
                        " do método setResult(int resultCode,[Intent data]) na Activity da Tela 3,\n Valor retornado: " + value);
            }
            /*
              Padrões:
              RESULT_CANCELED (0x00000000) / RESULT_FIRST_USER (0x0000001) / RESULT_OK (0xffffffff)
            */
        }
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
