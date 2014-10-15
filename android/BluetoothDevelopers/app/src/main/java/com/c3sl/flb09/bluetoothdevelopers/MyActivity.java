package com.c3sl.flb09.bluetoothdevelopers;

import android.app.Activity;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.os.Parcelable;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Set;


public class MyActivity extends Activity {

    private BluetoothAdapter mBluetoothAdapter = null;
    private Button bt_find_stop;
    private Button bt_list;
    private Button bt_disc;
    private Button bt_on;
    private Button bt_off;
    private TextView tv_text;
    private int DISCOVERABLE_DURATION = 15;
    private ArrayAdapter<String> mArrayAdapter;
    private Set<BluetoothDevice> pairedDevices;
    private ListView listView;

    // É um requestCode(qualquer inteiro > 0 único), que pode ser checado
    // com onActivityResult()
    private static final int REQUEST_ENABLE_BT = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my);

        tv_text = (TextView) findViewById(R.id.tv_text);
        bt_on = (Button) findViewById(R.id.bt_on);
        bt_off = (Button) findViewById(R.id.bt_off);
        bt_disc = (Button) findViewById(R.id.bt_disc);
        bt_list = (Button) findViewById(R.id.bt_list);
        bt_find_stop = (Button) findViewById(R.id.bt_find_stop);
        mBluetoothAdapter = BluetoothAdapter.getDefaultAdapter();

        // Verifica se o aparelho possui Bluetooth
        if(mBluetoothAdapter == null) {
            bt_find_stop.setEnabled(false);
            bt_list.setEnabled(false);
            bt_on.setEnabled(false);
            bt_off.setEnabled(false);
            bt_disc.setEnabled(false);
            tv_text.setText("Status: not supported");
            Toast.makeText(this, "Device does not support Bluetooth", Toast.LENGTH_LONG).show();
        } else {

            if(!mBluetoothAdapter.isEnabled()) {
                disableButtons();
            }

            // Ativar Bluetooth
            bt_on.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    bluetooth_on(view);
                }
            });

            // Desativar Bluetooth
            bt_off.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    bluetooth_off(view);
                }
            });

            bt_disc.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    setDeviceVisible();
                }
            });

            // Listar dispositivos pareados
            bt_list.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    bluetooth_list_pared(view);
                }
            });

            // Descobrindo dispositivos
            bt_find_stop.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    find(view);
                }
            });

            // Array para dispositivos pareados e descobertos
            mArrayAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1);

            listView = (ListView) findViewById(R.id.lv_pared_devices);
            listView.setAdapter(mArrayAdapter);

            registerBR();

        }
    }

    public void registerBR() {
        // registrando o BroadcastReceiver, desregistrar no onDestroy()
        IntentFilter filter = new IntentFilter();
        // Para identificar pelo Broadcast Receiver quando um dispositivo por encontrado
        filter.addAction(BluetoothDevice.ACTION_FOUND);
        // Para identificar o final do modo de descoberta
        filter.addAction(BluetoothAdapter.ACTION_DISCOVERY_FINISHED);
        // Para decobrir quando saiu/entrou do modo visível
        filter.addAction(BluetoothAdapter.ACTION_SCAN_MODE_CHANGED);
        this.registerReceiver(mReceiver,filter);
        //registerReceiver(mReceiver, new IntentFilter(BluetoothDevice.ACTION_FOUND));
    }

    // Descobrindo dispositivos
    // Criando um BroadcatReceiver para ACTION_FOUND, para receber informações
    // sobre  cada dispositivo descoberto
    private final BroadcastReceiver mReceiver = new BroadcastReceiver() {
        @Override
        public void onReceive(Context context, Intent intent) {
            String action = intent.getAction();
            // Quando 'discovery' encontrar um dispositivo
            if(BluetoothDevice.ACTION_FOUND.equals(action)) {
                // obtem o objeto BluetoothDevice (remoto) do intent
                BluetoothDevice device = intent.getParcelableExtra(BluetoothDevice.EXTRA_DEVICE);
                mArrayAdapter.add(device.getName() + "\n" + device.getAddress() + "\n" + "finded");
                mArrayAdapter.notifyDataSetChanged();
            } else if(BluetoothAdapter.ACTION_DISCOVERY_FINISHED.equals(action)) {
                if(mBluetoothAdapter.isEnabled())
                    bt_find_stop.setEnabled(true);
                bt_find_stop.setText(R.string.find_stop);
            } else if (BluetoothAdapter.ACTION_SCAN_MODE_CHANGED.equals(action)) {
                if((BluetoothAdapter.EXTRA_PREVIOUS_SCAN_MODE.equals(
                        BluetoothAdapter.SCAN_MODE_CONNECTABLE_DISCOVERABLE) ||
                        BluetoothAdapter.EXTRA_PREVIOUS_SCAN_MODE.equals(
                                BluetoothAdapter.SCAN_MODE_NONE))){
                    bt_disc.setEnabled(true);
                    tv_text.setText("Status: end discoverable.");
                } else {
                    tv_text.setText("Status: scan mode: PV: "+ BluetoothAdapter.EXTRA_PREVIOUS_SCAN_MODE + "Actual:"+BluetoothAdapter.EXTRA_SCAN_MODE);

                }
            }
        }
    };

    public void setDeviceVisible() {
        // Se o Bluetooth não estiver ativo, então ele será
        // automaticamenta ativado
        enableButtons();
        Intent enablaBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_DISCOVERABLE);
        enablaBtIntent.putExtra(BluetoothAdapter.EXTRA_DISCOVERABLE_DURATION,DISCOVERABLE_DURATION);
        startActivityForResult(enablaBtIntent, REQUEST_ENABLE_BT);
        bt_disc.setEnabled(false);
    }

    public void enableButtons() {
        bt_find_stop.setEnabled(true);
        bt_list.setEnabled(true);
        bt_off.setEnabled(true);
        bt_on.setEnabled(false);
    }

    public void disableButtons() {
        bt_find_stop.setEnabled(false);
        bt_list.setEnabled(false);
        bt_off.setEnabled(false);
        bt_on.setEnabled(true);
        tv_text.setText("Ative o Bluetooth!!!");
    }

    public void find(View v) {
        // Se estiver buscando disposito então para de buscar
        if (mBluetoothAdapter.isEnabled())
            if (mBluetoothAdapter.isDiscovering()) {
                mBluetoothAdapter.cancelDiscovery();
            } else { // inicia busca
                mArrayAdapter.clear();
                bt_find_stop.setEnabled(false);
                bt_find_stop.setText("Pesquisando...");
                mBluetoothAdapter.startDiscovery();
            }
    }

    public void bluetooth_on(View view) {
        // Verifica se o Bluetooth está ativo
        if(!mBluetoothAdapter.isEnabled()) {
            // Solicita a ativação do Bluetooth
            Intent enableBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
            startActivityForResult(enableBtIntent, REQUEST_ENABLE_BT);
            Toast.makeText(getApplicationContext(),"Bluetooth turned on",
                    Toast.LENGTH_LONG).show();
            enableButtons();
        } else {
            Toast.makeText(getApplicationContext(),"Bluetooth is already on",
                    Toast.LENGTH_LONG).show();
        }
    }

    public void bluetooth_off(View view) {
        mBluetoothAdapter.disable();
        tv_text.setText("Status: Disconnected");
        Toast.makeText(getApplicationContext(),"Bluetooth turned off",
                Toast.LENGTH_LONG).show();
        disableButtons();
        mArrayAdapter.clear();
    }

    public void bluetooth_list_pared(View view){
        // Buscando na lista de aplicativos pareados
        pairedDevices = mBluetoothAdapter.getBondedDevices();
        // Se existirem aparelhos pareados
        if(pairedDevices.size() > 0) {
            mArrayAdapter.clear();
            // lopp na lista de aparelhos pareados
            for (BluetoothDevice device: pairedDevices) {
                // Adiciona o name e o MAC adress em um array adapter para
                // mostrar em uma ListView
                mArrayAdapter.add(device.getName() + "\n" + device.getAddress() + "\n" + "Pared");
            }
            Toast.makeText(getApplicationContext(),"Show Paired Devices",
                    Toast.LENGTH_SHORT).show();
        } else {
            Toast.makeText(getApplicationContext(),"Paired Devices not found",
                    Toast.LENGTH_SHORT).show();
        }
    }


    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if(requestCode == REQUEST_ENABLE_BT) {
            tv_text.setText("Status: Enable");
        } else {
            tv_text.setText("Status: Disable");
        }
    }


    @Override
    protected void onDestroy() {
        super.onDestroy();
        unregisterReceiver(mReceiver);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.my, menu);
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
