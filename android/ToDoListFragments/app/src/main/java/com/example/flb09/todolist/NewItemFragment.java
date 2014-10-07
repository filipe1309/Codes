package com.example.flb09.todolist;

import android.app.Activity;
import android.app.Fragment;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;

/**
 * Created by flb09 on 02/10/14.
 */
public class NewItemFragment extends Fragment{
    private OnNewItemAddedListener onNewItemAddedListener;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        //return inflater.inflate(R.layout.new_item_fragment, container, false);
        View view = inflater.inflate(R.layout.new_item_fragment, container, false);

        final EditText myEditText = (EditText) view.findViewById(R.id.myEditText);

        myEditText.setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View view, int keyCode, KeyEvent keyEvent) {
                if(keyEvent.getAction() == KeyEvent.ACTION_DOWN){
                    if((keyCode == KeyEvent.KEYCODE_DPAD_CENTER) || (keyCode == keyEvent.KEYCODE_ENTER)){
                       String newItem = myEditText.getText().toString();
                        onNewItemAddedListener.onNewItemAdded(newItem);
                       myEditText.setText("");
                       return true;
                    }
                }
                return false;
            }

        });

        return view;
    }

    public interface OnNewItemAddedListener {
        public void onNewItemAdded(String newItem);
    }

    @Override
    public void onAttach(Activity activity) {
        super.onAttach(activity);

        try{
            onNewItemAddedListener = (OnNewItemAddedListener) activity;
        } catch (ClassCastException e) {
            throw new ClassCastException(activity.toString() + " must implement OnNewItemAddedListener");
        }
    }
}
