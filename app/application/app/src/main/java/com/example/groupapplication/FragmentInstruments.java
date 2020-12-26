package com.example.groupapplication;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

///**
// * A simple {@link Fragment} subclass.
// * Use the {@link FragmentInstruments#newInstance} factory method to
// * create an instance of this fragment.
// */
public class FragmentInstruments extends Fragment {

    private RecyclerView recyclerView;
    private RecyclerView.Adapter adapter;
    private RecyclerView.LayoutManager layoutManager;

    private String[] instruments, instruments_prices, instruments_codes;
    private int[] instruments_images = {R.drawable.drums, R.drawable.trumpet, R.drawable.guitar,
            R.drawable.piano, R.drawable.flute, R.drawable.violin};
    private View listItemsView;

    public static FragmentInstruments newInstance() {
        return new FragmentInstruments();
    }

    @Nullable
//    @Override
//    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState){
//
//        instruments = getResources().getStringArray(R.array.instruments);
//        instruments_prices = getResources().getStringArray(R.array.instruments_prices);
//
//        listItemsView = inflater.inflate(R.layout.fragment_instruments, container, false);
//        recyclerView = listItemsView.findViewById((R.id.product_list));
//
//        layoutManager = new LinearLayoutManager(getContext());
//        recyclerView.setLayoutManager(layoutManager);
//
//        adapter = new InstrumentRecyclerViewAdapter(instruments, instruments_prices, images);
//        recyclerView.setAdapter(adapter);
//
//        return super.onCreateView(inflater, container, savedInstanceState);
//    }
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        // Inflate the layout for this fragment
        listItemsView = inflater.inflate(R.layout.fragment_instruments, container, false);
        // connect with layout
        recyclerView = listItemsView.findViewById(R.id.product_list);
        // set layout manager
        recyclerView.setLayoutManager(new LinearLayoutManager(listItemsView.getContext()));
        //get instruments from values
        instruments = getResources().getStringArray(R.array.instruments);
        //get prices from values
        instruments_prices = getResources().getStringArray(R.array.instruments_prices);
        instruments_codes = getResources().getStringArray(R.array.instruments_codes);
        // make an adapter with all the values which will go into each row
        adapter = new RecyclerviewAdapterInstrument(instruments, instruments_prices, instruments_codes, instruments_images);
        //set adapter
        recyclerView.setAdapter(adapter);
        //set linear layout to display items vertically
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getActivity(), RecyclerView.VERTICAL, false);
        recyclerView.setLayoutManager(linearLayoutManager);
        //return this view on create
        return listItemsView;
    }


}