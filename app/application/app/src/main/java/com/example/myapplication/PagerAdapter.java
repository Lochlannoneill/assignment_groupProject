package com.example.myapplication;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;

public class PagerAdapter extends FragmentPagerAdapter {

    private int numOfTabs;

//    public PagerAdapter(FragmentManager fm, int numOfTabs) {
//        super(fm);
//        this.numOfTabs = numOfTabs;
//    }

    public PagerAdapter(@NonNull FragmentManager fm, int behaviour, int numOfTabs) {
        super(fm, behaviour);
        this.numOfTabs = numOfTabs;
    }

    @NonNull
    @Override
    public Fragment getItem(int position) {

        switch (position) {
            case 0:
                return new FragmentPrediction();
            case 1:
                return new FragmentDetails();
            case 2:
                return new FragmentPayments();
            default: return null;
        }

    }

    @Override
    public int getCount() {

        return numOfTabs;
    }
}
