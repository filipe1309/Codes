package com.c3sl.flb09.androidlistviewcursoradapter;

import android.app.Activity;
import android.database.Cursor;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.FilterQueryProvider;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.Toast;


public class AndroidListViewCursorAdapterActivity extends Activity {

    private CountriesDbAdapter dbHelper;
    private SimpleCursorAdapter dataAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_android_list_view_cursor_adapter);

        dbHelper = new CountriesDbAdapter(this);
        dbHelper.open();

        //Clean all data
        dbHelper.deleteAllCountries();
        //Add some data
        dbHelper.insertSomeCountries();

        //Generate ListView from SQLite Database
        displayListView();
    }

    private void displayListView() {
        Cursor cursor = dbHelper.fetchAllCountries();

        // The desire columns to be bound
        String[] columns = new String[] {
          CountriesDbAdapter.KEY_CODE,
          CountriesDbAdapter.KEY_NAME,
          CountriesDbAdapter.KEY_CONTINENT,
          CountriesDbAdapter.KEY_REGION
        };

        // the XML defined views which the data will be bound to
        int[] to = new int[] {
            R.id.code,
            R.id.name,
            R.id.continent,
            R.id.region,
         };

        // create the adapter using the cursor pointing to the desired data
        //as well as the layout information
        dataAdapter = new SimpleCursorAdapter(
                this, R.layout.country_info,
                cursor,
                columns,
                to,
                0
            );
        ListView listView = (ListView) findViewById(R.id.listView1);
        // Assign adapter to ListView
        listView.setAdapter(dataAdapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> listView, View view, int position, long id) {
                // Get the cursor, positioned to the corresponding row in the result set
                Cursor cursor = (Cursor) listView.getItemAtPosition(position);

                // Get the state's capital from this row in the database.
                String countryCode = cursor.getString(cursor.getColumnIndexOrThrow("code"));
                Toast.makeText(getApplicationContext(),
                 countryCode, Toast.LENGTH_SHORT).show();
                }
            });

        EditText myFilter = (EditText) findViewById(R.id.myFilter);
        myFilter.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {
            }

            public void beforeTextChanged(CharSequence s, int start,
                                          int count, int after) {
            }

            public void onTextChanged(CharSequence s, int start,
                                      int before, int count) {
                dataAdapter.getFilter().filter(s.toString());
            }
        });

        dataAdapter.setFilterQueryProvider(new FilterQueryProvider() {
             public Cursor runQuery(CharSequence constraint) {
                 return dbHelper.fetchCountriesByName(constraint.toString());
             }
        });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.android_list_view_cursor_adapter, menu);
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
