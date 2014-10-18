package com.c3sl.flb09.bluetoothdevelopers;

import android.app.Activity;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.bluetooth.BluetoothServerSocket;
import android.bluetooth.BluetoothSocket;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.os.Message;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.Set;
import java.util.UUID;
import java.util.logging.Handler;
import java.util.logging.LogRecord;


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
    // Server
    private UUID MY_UUID = UUID.fromString("00001101-0000-1000-8000-00805F9B34FB");
    public Handler mHandler;
    public Handler aHandler;


    private String answer;
    private static final int SUCCESS = 0;
    private static final int FAIL = 1;
    public static final int ANSWER = 2;
    public static final int DISCONNECTED = 0;
    public static final int CONNECTED = 1;
    public static final int CONNECTING = 2;

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
        aHandler = new Handler() {
            @Override
            public void close() {

            }

            @Override
            public void flush() {

            }

            @Override
            public void publish(LogRecord logRecord) {

            }
        };

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

            if(!mBluetoothAdapter.isEnabled()) { disableButtons(); }

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
        // Registrando o BroadcastReceiver, desregistrar no onDestroy()
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
                // Quando mudar modo visivel
                int scanMode = intent.getIntExtra(BluetoothAdapter.EXTRA_SCAN_MODE,0);
                //int scanModePrevious = intent.getIntExtra(
                //        BluetoothAdapter.EXTRA_PREVIOUS_SCAN_MODE, 0);

                if (scanMode == BluetoothAdapter.SCAN_MODE_CONNECTABLE_DISCOVERABLE) {
                    bt_disc.setEnabled(false);
                } else {
                    bt_disc.setEnabled(true);
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
        //bt_disc.setEnabled(false);
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

    public void find(View view) {
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

        /*
        * se o usuário aceitar(YES) entrar em modo visivel(discoverable), então o result Code
        * será igual a duração em que o aparecho ficará neste modo, caso contrário,
        * (NO) ou se um erro ocorrer, o result Code será RESULT_CANCELED
        * */
    }


    @Override
    protected void onDestroy() {
        super.onDestroy();
        unregisterReceiver(mReceiver);
    }


    // Server
    private class AcceptThread extends Thread {
        private final BluetoothServerSocket mmServerSocket;

        public AcceptThread() {
            // Use a temporary object that is later assigned to mmServerSocket,
            // because mmServerSocket is final
            BluetoothServerSocket tmp = null;
            try {
                // MY_UUID is the app's UUID string, also used by the client code
                tmp = mBluetoothAdapter.listenUsingRfcommWithServiceRecord(getName(), MY_UUID);
            } catch (IOException e) {
            }
            mmServerSocket = tmp;
        }

        public BluetoothServerSocket getMmServerSocket() {
            return mmServerSocket;
        }

        public void run() {
            BluetoothSocket socket = null;
            // Keep listening until exception occurs or a socket is returned
            while (true) {
                try {
                    socket = mmServerSocket.accept();
                } catch (IOException e) {
                    break;
                }
                // If a connection was accepted
                if (socket != null) {
                    // Do work to manage the connection (in a separate thread)
                    //manageConnectedSocket(socket);
                    try {
                        mmServerSocket.close();
                        break;
                    } catch (IOException e) {
                        //TODO Auto-generated catch block
                        e.printStackTrace();
                    }
                    break;
                }
            }
        }

        /** Will cancel the listening socket, and cause the thread to finish */
        public void cancel() {
            try {
                mmServerSocket.close();
            } catch (IOException e) { }
        }

    }

    private class ConnectThread extends Thread {
        private final BluetoothSocket mmSocket;
        private final BluetoothDevice mmDevice;

        public ConnectThread(BluetoothDevice device) {
            // Use a temporary object that is later assigned to mmSocket,
            // because mmSocket is final
            BluetoothSocket tmp = null;
            mmDevice = device;

            // Get a BluetoothSocket to connect with the given BluetoothDevice
            try {
                // MY_UUID is the app's UUID string, also used by the server code
                tmp = device.createRfcommSocketToServiceRecord(MY_UUID);
            } catch (IOException e) { }
            mmSocket = tmp;
        }

        public void run() {
            // Cancel discovery because it will slow down the connection
            mBluetoothAdapter.cancelDiscovery();

            try {
                // Connect the device through the socket. This will block
                // until it succeeds or throws an exception
                mmSocket.connect();
            } catch (IOException connectException) {
                // Unable to connect; close the socket and get out
                try {
                    mmSocket.close();
                } catch (IOException closeException) { }
                return;
            }

            // Do work to manage the connection (in a separate thread)
            //manageConnectedSocket(mmSocket);
        }

        /** Will cancel an in-progress connection, and close the socket */
        public void cancel() {
            try {
                mmSocket.close();
            } catch (IOException e) { }
        }
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

    private class ConnectedThread extends Thread {
        private final BluetoothSocket mmSocket;
        private final InputStream mmInStream;
        private final OutputStream mmOutStream;

        public ConnectedThread(BluetoothSocket socket) {
            mmSocket = socket;
            InputStream tmpIn = null;
            OutputStream tmpOut = null;

            // Get the input and output streams, using temp objects because
            // member streams are final
            try {
                tmpIn = socket.getInputStream();
                tmpOut = socket.getOutputStream();
            } catch (IOException e) { }

            mmInStream = tmpIn;
            mmOutStream = tmpOut;
        }

        public void run() {
            byte[] buffer = new byte[1024];  // buffer store for the stream
            int bytes; // bytes returned from read()

            // Keep listening to the InputStream until an exception occurs
            while (true) {
                try {
                    // Read from the InputStream
                    bytes = mmInStream.read(buffer);
                    // Send the obtained bytes to the UI activity
                    //aHandler.obtainMessage(MESSAGE_READ, bytes, -1, buffer)
                    //        .sendToTarget();
                } catch (IOException e) {
                    break;
                }
            }
        }

        /* Call this from the main activity to send data to the remote device */
        public void write(byte[] bytes) {
            try {
                mmOutStream.write(bytes);
            } catch (IOException e) { }
        }

        /* Call this from the main activity to shutdown the connection */
        public void cancel() {
            try {
                mmSocket.close();
            } catch (IOException e) { }
        }
    }

}
