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

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link FragmentGroceries#newInstance} factory method to
 * create an instance of this fragment.
 */
public class FragmentGroceries extends Fragment {

    private RecyclerView recyclerView;
    private RecyclerView.Adapter adapter;
    private RecyclerView.LayoutManager layoutManager;

    private String[] groceries, groceries_prices, groceries_codes;
    private int[] groceries_images = {R.drawable.milk, R.drawable.pizza, R.drawable.steak,
            R.drawable.bread, R.drawable.fish, R.drawable.honey};
    private View listItemsView;

    public static FragmentGroceries newInstance() {
        return new FragmentGroceries();
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
        listItemsView = inflater.inflate(R.layout.fragment_groceries, container, false);
        // connect with layout
        recyclerView = listItemsView.findViewById(R.id.product_list);
        // set layout manager
        recyclerView.setLayoutManager(new LinearLayoutManager(listItemsView.getContext()));
        //get instruments from values
        groceries = getResources().getStringArray(R.array.groceries);
        //get prices from values
        groceries_prices = getResources().getStringArray(R.array.groceries_prices);
        groceries_codes = getResources().getStringArray(R.array.groceries_codes);
        // make an adapter with all the values which will go into each row
        adapter = new RecyclerviewAdapterGrocery(groceries, groceries_prices, groceries_codes, groceries_images);
        //set adapter
        recyclerView.setAdapter(adapter);
        //set linear layout to display items vertically
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getActivity(), RecyclerView.VERTICAL, false);
        recyclerView.setLayoutManager(linearLayoutManager);
        //return this view on create
        return listItemsView;
    }

}